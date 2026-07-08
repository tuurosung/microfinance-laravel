<?php

declare(strict_types= 1);

namespace App\Domain\Transactions\Services;

use App\Domain\Accounts\Models\Account;
use App\Domain\Transactions\Contracts\LedgerInterface;
use App\Domain\Transactions\Models\Transaction;
use App\Domain\Transactions\Services\JournalEntry;
use App\DTOs\Accounts\AccountBalances;
use App\Enums\Accounts\GlTypeEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LedgerService implements LedgerInterface
{

    public function post(JournalEntry $entry): string
    {
        return DB::transaction(function() use($entry): string {

            $debit = Account::with("gl")->lockForUpdate()->findOrFail($entry->debitAccountId);
            $credit = Account::with("gl")->lockForUpdate()->findOrFail($entry->creditAccountId);

            $this->guardPostable($debit);
            $this->guardPostable($credit);

            Log::info("Postable checks passed");

            $this->guardSufficientFunds($debit, $credit, $entry->amountPesewas);

            $idempotencyHash = $entry->idempotencyHash();

            // Idempotent: a retried post returns the original reference.
            $existing = Transaction::where("idempotency_hash", $idempotencyHash)->first();

            if ($existing !== null) {
                return $existing->reference;
            }

            $ref = (string) Str::uuid();

            Transaction::create([
                "reference"=> $ref,
                "debit_account_id"=> $entry->debitAccountId,
                "credit_account_id" => $entry->creditAccountId,
                "amount_pesewas"=> $entry->amountPesewas,
                "type"=> $entry->transactionType,
                "channel"=> $entry->channel,
                "narration"=> $entry->narration,
                "value_date" => $entry->valueDate?->toDateString() ?? now()->toDateString(),
                "posted_by" => $entry->userId,
                "reversal_of" => $entry->reversalOfTransactionId,
                "idempotency_hash"=> $idempotencyHash,
                "integrity_hash"=> $this->buildIntegrityHash($ref, $entry),
            ]);

            $now = now();
            $debit->forceFill(['last_transaction_at' => $now])->save();
            $credit->forceFill(['last_transaction_at' => $now])->save();

            return $ref;
        });
    }


    /**
     * Signed by GL type: assets/expenses are debit-normal,
     * liabilities/income are credit-normal.
     */
    public function balances(Account $account): AccountBalances
    {
        $debits = (int) Transaction::where('debit_account_id', $account->account_id)->sum('amount_pesewas');
        $credits = (int) Transaction::where('credit_account_id', $account->account_id)->sum('amount_pesewas');

        $glType = GlTypeEnum::from($account->gl->type->value);

        $ledger = $glType->isDebitNormal()
            ? $debits - $credits
            : $credits - $debits;

        // $liens = (int) $account->liens()->where('status', 'active')->sum('amount_pesewas');

        // TODO when liens are defined, availableBalancePesewas = $ledger - $liens

        return new AccountBalances(
            ledgerBalancePesewas: $ledger,
            availableBalancePesewas: $ledger,
            debit: $debits,
            credit: $credits
        );
    }


    public function reverse(Transaction $original, int $userId, string $reason): string
    {
        $this->post(JournalEntry::reversal($original, $userId, $reason));
    }


    /**
     * The ledger blocks closed/suspended accounts outright. Dormancy is a
     * channel policy (deposits may land and reactivate; withdrawals may not)
     * and is enforced at the service layer, not here.
     */
    public function guardPostable(Account $account): void
    {
        if (in_array($account->status, ['closed', 'suspended'], true)) {

            $error = "Account {$account->account_number} is {$account->status} and cannot be posted to";
            Log::error($error);
            throw new \DomainException($error);

        }

        Log::info("Account {$account->account_name} passed postable check");
    }


    /**
     * Guard whichever leg DECREASES:
     *  - a debit decreases a credit-normal account (customer deposits),
     *  - a credit decreases a debit-normal account (cash till, MoMo float).
     * Income/expense system accounts are exempt by construction.
     */
    public function guardSufficientFunds(Account $debit, Account $credit, int $amountPesewas): void
    {
        Log::info("Checking for sufficiency");

        $debitGl = GlTypeEnum::from($debit->gl->type->value);
        $creditGl = GlTypeEnum::from($credit->gl->type->value);

        if (! $debitGl->isDebitNormal()) {
            $available = $this->balances($debit)->availableBalancePesewas;
            if ($available < $amountPesewas) {
                throw new \DomainException("Insuffiencient available balance on {$debit->account_number}");
            }
        }


        if ($creditGl->isDebitNormal() && $creditGl === GlTypeEnum::Asset) {
            $available = $this->balances($debit)->availableBalancePesewas;

            if ($available < $amountPesewas) {
                throw new \DomainException("Insufficient funds in {$credit->account_number} (till/float cannot go negative).");
            }

        }
    }


    public function buildIntegrityHash(string $ref, JournalEntry $entry): string
    {
        return hash_hmac("sha256",
            $ref .
            $entry->debitAccountId .
            $entry->creditAccountId .
            $entry->amountPesewas .
            $entry->narration,
            config('app.key')
        );
    }
}
