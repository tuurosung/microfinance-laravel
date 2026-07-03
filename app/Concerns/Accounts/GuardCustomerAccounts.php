<?php

declare(strict_types= 1);

namespace App\Concerns\Accounts;

use App\Domain\Accounts\Models\Account;
use App\Enums\Accounts\AccountStatusEnum;

trait GuardCustomerAccounts
{
    private function guardDepositatable(Account $account): void
    {
        if (! in_array($account->status , [AccountStatusEnum::DORMANT, AccountStatusEnum::ACTIVE])) {
            throw new \DomainException("Account {$account->account_number} is {$account->status}; deposits not allowed.");
        }

        $this->guardKycApproved($account);
    }


    private function guardWithdrawable(Account $account): void
    {
        if ($account->status !== 'active')
        {
            throw new \DomainException("Account {$account->account_number} is not active; withdrawals are not allowed");
        }

        $this->guardKycApproved($account);
    }


    private function guardKycApproved(Account $account): void
    {
        if ($account->cif->kyc_status !== 'approved')
        {
            throw new \DomainException("The KYC on the owner of this account is incomplete. Transactions are not allowed");
        }
    }
}
