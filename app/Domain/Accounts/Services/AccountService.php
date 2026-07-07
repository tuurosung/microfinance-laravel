<?php

namespace App\Domain\Accounts\Services;

use App\Domain\Accounts\Contracts\AccountRepositoryInterface;
use App\Domain\Accounts\Models\Account;
use App\Domain\Accounts\Models\ChartOfAccount;
use App\Domain\DepositAccount\Models\DepositAccount;
use App\Enums\Accounts\AccountTypeEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AccountService
{
    public function __construct(
        private readonly AccountRepositoryInterface $accounts,
        private readonly AccountNumberGenerator $accountNumbers
    ) {}

    public function open(array $data): Account
    {
        $type = AccountTypeEnum::from($data['account_type']);

        if ($type->isSystemAccount()) {
            throw new \DomainException("Account type '{$type->value}' is a system type and cannot be opened for a customer.");
        }

        return DB::transaction(function () use ($data, $type): Account {

            $gl = ChartOfAccount::where('code', $type->glCode())->firstOrFail();

            return Account::create([
                'account_id'              => (string) Str::uuid(),
                'cif_id'                  => $data['cif_id'],
                'account_type'            => $type,
                'status'                  => 'active',
                'mandate_type'            => $data['mandate_type'],
                'minimum_balance_pesewas' => $data['minimum_balance_pesewas'] ?? 0,
                'gl_account_id'           => $gl->id,
                'account_number'          => $this->accountNumbers->next($type, '002'),
                'opened_by'               => auth()->user()->id,
            ]);
        });
    }


    public function suspend(Account $account, string $actorId, string $reason): void
    {
        if ($account->account_type->isSystemAccount()) {
            throw new \DomainException('System accounts cannot be suspended.');
        }

        $account->update(['status' => 'suspended']);

        \App\Models\AuditTrail::log($account, $actorId, 'ACCOUNT_SUSPENDED', 'active', 'suspended', $reason);
    }

    public function close(Account $account, string $actorId, string $reason): void
    {
        if ($account->account_type->isSystemAccount()) {
            throw new \DomainException('System accounts cannot be closed.');
        }

        if ($account->liens()->where('status', 'active')->exists()) {
            throw new \DomainException('Account has active liens and cannot be closed.');
        }

        $account->update(['status' => 'closed']);

        \App\Models\AuditTrail::log($account, $actorId, 'ACCOUNT_CLOSED', $account->getOriginal('status'), 'closed', $reason);
    }




    /**
     * Sequential, checked-unique account number. Replaces the earlier
     * rand(1000, 9000) approach in the model's creating() hook, which had
     * no collision check across an 8,000-value space.
     */
    private function generateAccountNumber(): string
    {
        do {
            $candidate = (string) random_int(100000000, 999999999);
        } while (Account::where('account_number', $candidate)->exists());

        return $candidate;
    }

}
