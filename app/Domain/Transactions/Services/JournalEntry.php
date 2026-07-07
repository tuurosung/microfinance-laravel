<?php

declare (strict_types= 1);

namespace App\Domain\Transactions\Services;

use App\Domain\Transactions\Models\Transaction;
use App\Enums\Transactions\TransactionChannelEnum;
use App\Enums\Transactions\TransactionTypeEnum;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Log;


/**
 * Immutable double-entry posting instruction.
 *
 * Construction goes through the named factories below, which own the posting
 * direction for each movement type. Services say WHAT happened (a deposit,
 * a repayment); this object knows WHICH LEG each account lands on. That
 * knowledge lives in exactly one place.
 *
 * A JournalEntry that exists is structurally valid: positive amount,
 * distinct legs, bounded narration and idempotency key. Whether it is
 * POSTABLE (sufficient funds, account status) is the ledger's decision,
 * not this object's. Construction failures throw InvalidArgumentException
 * because they are programming errors; business rejections remain
 * DomainException territory inside LedgerService.
 */
final readonly class JournalEntry
{
    private const NARRATION_MAX = 255;
    private const IDEMPOTENCY_KEY_MAX = 100;


    public function __construct(
        public string $debitAccountId,
        public string $creditAccountId,
        public int $amountPesewas,
        public TransactionTypeEnum $transactionType,
        public string $narration,
        public string $idempotencyKey,
        public int $userId,
        public TransactionChannelEnum $channel,
        public ?CarbonImmutable $valueDate,
        public ?int $reversalOfTransactionId = null
    ) {
        $this->guardStructure();
    }


    // ── Factories: one per money movement, direction encoded once ───────

    /**
     * Money into a customer account. The funding account is the asset that
     * increases: the cash till (counter) or a provider float (MoMo).
     *
     *   DR funding asset · CR customer liability
     */
    public static function deposit(
        string $fundingAccountId,
        string $customerAccountId,
        int $amountPesewas,
        string $narration,
        string $idempotencyKey,
        int $userId,
        TransactionChannelEnum $channel = TransactionChannelEnum::Counter,
        ?CarbonImmutable $valueDate = null
    ) : self {

        Log::info("Initializing journal entry - deposit");

        $depositEntry = new self(
            debitAccountId: $fundingAccountId,
            creditAccountId: $customerAccountId,
            amountPesewas: $amountPesewas,
            transactionType: TransactionTypeEnum::Deposit,
            narration: $narration,
            idempotencyKey: $idempotencyKey,
            userId: $userId,
            channel: $channel,
            valueDate: $valueDate
        );

        if (! $depositEntry) {
            Log::error("Unable to create deposit instance");
        }

        Log::info("Journal Entry Successful", [$depositEntry]);
        return $depositEntry;
    }


    /**
     * Money out of a customer account. The payout account is the asset that
     * decreases: the cash till (counter) or a provider float (MoMo).
     *
     *   DR customer liability · CR payout asset
     */
    public static function withdrawal(
        int $customerAccountId,
        int $payoutAccountId,
        int $amountPesewas,
        string $narration,
        string $idempotencyKey,
        int $actorId,
        TransactionChannelEnum $channel = TransactionChannelEnum::Counter,
        ?CarbonImmutable $valueDate = null,
    ): self {
        return new self(
            debitAccountId: $customerAccountId,
            creditAccountId: $payoutAccountId,
            amountPesewas: $amountPesewas,
            type: TransactionTypeEnum::Withdrawal,
            narration: $narration,
            idempotencyKey: $idempotencyKey,
            actorId: $actorId,
            channel: $channel,
            valueDate: $valueDate,
        );
    }



    /**
     *   DR loan float · CR borrower account
     */
    public static function loanDisbursement(
        int $loanFloatAccountId,
        int $borrowerAccountId,
        int $amountPesewas,
        string $narration,
        string $idempotencyKey,
        int $actorId,
        ?CarbonImmutable $valueDate = null,
    ): self {
        return new self(
            debitAccountId: $loanFloatAccountId,
            creditAccountId: $borrowerAccountId,
            amountPesewas: $amountPesewas,
            type: TransactionTypeEnum::LoanDisbursement,
            narration: $narration,
            idempotencyKey: $idempotencyKey,
            actorId: $actorId,
            channel: TransactionChannelEnum::Counter,
            valueDate: $valueDate,
        );
    }



    /**
     * One repayment component. Call twice per instalment: once with the
     * loan float (principal), once with interest income (interest).
     *
     *   DR borrower account · CR loan float | interest income
     */
    public static function repayment(
        int $borrowerAccountId,
        int $receivingAccountId,
        int $amountPesewas,
        string $narration,
        string $idempotencyKey,
        int $actorId,
        TransactionChannelEnum $channel = TransactionChannelEnum::Counter,
        ?CarbonImmutable $valueDate = null,
    ): self {
        return new self(
            debitAccountId: $borrowerAccountId,
            creditAccountId: $receivingAccountId,
            amountPesewas: $amountPesewas,
            type: TransactionTypeEnum::Repayment,
            narration: $narration,
            idempotencyKey: $idempotencyKey,
            actorId: $actorId,
            channel: $channel,
            valueDate: $valueDate,
        );
    }



    /**
     *   DR customer account · CR income account
     */
    public static function fee(
        int $customerAccountId,
        int $incomeAccountId,
        int $amountPesewas,
        string $narration,
        string $idempotencyKey,
        int $actorId,
        TransactionChannelEnum $channel = TransactionChannelEnum::Counter,
    ): self {
        return new self(
            debitAccountId: $customerAccountId,
            creditAccountId: $incomeAccountId,
            amountPesewas: $amountPesewas,
            type: TransactionTypeEnum::Fee,
            narration: $narration,
            idempotencyKey: $idempotencyKey,
            actorId: $actorId,
            channel: $channel,
            valueDate: null,
        );
    }



    /**
     * Counter-entry for an existing posting. Legs flip; the original's id
     * travels on the entry so post() can populate transactions.reversal_of,
     * and the idempotency key derives from the original — a transaction can
     * only ever be reversed once.
     *
     * Requires the TransactionChannelEnum cast on the Transaction model.
     */
    public static function reversal(Transaction $original, int $actorId, string $reason): self
    {
        return new self(
            debitAccountId: $original->credit_account_id,
            creditAccountId: $original->debit_account_id,
            amountPesewas: (int) $original->amount_pesewas,
            type: TransactionTypeEnum::Reversal,
            narration: mb_substr("Reversal of {$original->reference}: {$reason}", 0, self::NARRATION_MAX),
            idempotencyKey: "reversal-{$original->id}",
            actorId: $actorId,
            channel: $original->channel,
            valueDate: null,
            reversalOfTransactionId: $original->id,
        );
    }



    // ── Derivations ──────────────────────────────────────────────────────

    /**
     * Deduplication key for the ledger. Pipe-separated: unseparated
     * concatenation lets (1, 23) and (12, 3) collide.
     */
    public function idempotencyHash(): string
    {
        return hash("sha256", implode('|', [
            $this->debitAccountId,
            $this->creditAccountId,
            $this->amountPesewas,
            $this->idempotencyKey
        ]));
    }



    // ── Invariants ───────────────────────────────────────────────────────
    private function guardStructure(): void
    {
        if ($this->amountPesewas < 1) {
            throw new \InvalidArgumentException("Journal amount must be at least 1 pesewa.");
        }


        if ($this->debitAccountId === $this->creditAccountId) {
            throw new \InvalidArgumentException("A journal entry cannot debit and credit the same account");
        }


        if ($this->debitAccountId == "" || $this->creditAccountId === "") {
            throw new \InvalidArgumentException("Journal accounts do not exist in the database");
        }


        if (trim($this->narration) === "" || mb_strlen($this->narration) > self::NARRATION_MAX) {
            throw new \InvalidArgumentException(sprintf("Narration must be 1-d% characters", self::NARRATION_MAX));
        }


        if (trim($this->idempotencyKey) === "" || mb_strlen($this->idempotencyKey) > self::IDEMPOTENCY_KEY_MAX) {
            throw new \InvalidArgumentException(sprintf("Idempotency key must be 1-d% characters. ", self::IDEMPOTENCY_KEY_MAX));
        }


        if ($this->userId < 1) {
            throw new \InvalidArgumentException("Journal entry requires a valid user id");
        }
    }




}
