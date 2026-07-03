<?php

namespace App\Domain\Transactions\Contracts;

use App\Domain\Accounts\Models\Account;
use App\Domain\Transactions\Models\MomoTransaction;
use App\DTOs\Transactions\DepositData;

interface DepositServiceInterface
{
    /**
     * Post a counter (teller) cash deposit. Returns the ledger reference.
     */
    public function counterDeposit(Account $account, DepositData $depositData): string;


    /**
     * Initiate a MoMo request-to-pay collection. The ledger entry is posted
     * only when the provider confirms via webhook.
     */
    public function initiateMomoDeposit(Account $account, DepositData $depositData): MomoTransaction;
}
