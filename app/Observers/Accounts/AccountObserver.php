<?php

namespace App\Observers\Accounts;

use App\Domain\Accounts\Models\Account;

class AccountObserver
{

    public function creating(Account $account): void
    {
        // $account->account_number ??= rand(1000, 9000);

        if (empty($model->opened_by) && auth()->check()) {
            $account->opened_by = auth()->user()->id;
        }
    }


    /**
     * Handle the Account "created" event.
     */
    public function created(Account $account): void
    {
        //
    }

    /**
     * Handle the Account "updated" event.
     */
    public function updated(Account $account): void
    {
        //
    }

    /**
     * Handle the Account "deleted" event.
     */
    public function deleted(Account $account): void
    {
        //
    }

    /**
     * Handle the Account "restored" event.
     */
    public function restored(Account $account): void
    {
        //
    }

    /**
     * Handle the Account "force deleted" event.
     */
    public function forceDeleted(Account $account): void
    {
        //
    }
}
