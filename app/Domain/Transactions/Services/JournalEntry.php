<?php


declare (strict_types= 1);

namespace App\Domain\Transactions\Services;

use App\Enums\Transactions\TransactionChannelEnum;
use App\Enums\Transactions\TransactionTypeEnum;
use Carbon\CarbonImmutable;

final readonly class JournalEntry
{
    private const NARRATION_MAX = 255;
    private const IDEMPOTENCY_KEY_MAX = 100;


    public function __construct(
        private string $debitAccountNumber,
        private string $creditAccountNumber,
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



    private function guardStructure(): void
    {
        if ($this->amountPesewas < 1) {
            throw new \InvalidArgumentException("Journal amount must be at least 1 pesewa.");
        }


        if ($this->debitAccountNumber === $this->creditAccountNumber) {
            throw new \InvalidArgumentException("A journal entry cannot debit and credit the same account");
        }


        if ($this->debitAccountNumber == "" || $this->creditAccountNumber === "") {
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
