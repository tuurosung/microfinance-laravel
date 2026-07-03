<?php

declare(strict_types= 1);

namespace App\Domain\Transactions\Contracts;

use App\Domain\Accounts\Models\Account;
use App\Domain\Transactions\Models\Transaction;
use App\Domain\Transactions\Services\JournalEntry;
use App\DTOs\Accounts\AccountBalances;

interface LedgerInterface
{

    /**
     * Post a double-entry journal. Returns the transaction reference.
     * Idempotent: re-posting the same entry returns the original reference.
     */
    public function post(JournalEntry $entry): string;


    public function balances(Account $account): AccountBalances;


    /**
     * Post a counter-entry. Never deletes. Returns the reversal reference.
     */
    public function reverse(Transaction $original, int $userId, string $reason): string;
}
