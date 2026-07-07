<?php

declare(strict_types= 1);

namespace App\Domain\Accounts\Services;

use App\Domain\Accounts\Models\Account;
use App\Enums\Accounts\AccountTypeEnum;
use Illuminate\Support\Facades\DB;

/**
 * Account number format: {branch_code}{type_code}{serial}
 *   e.g. 001-10-0000001
 *
 * Branch code: 3 digits, from config or the opening branch.
 * Type code:   2 digits, one per AccountTypeEnum case.
 * Serial:      7 digits, zero-padded, sequential PER branch+type pair.
 *
 * Sequential and gapless-per-scope, not random — an auditor should be able
 * to look at a number and immediately know the branch and product type
 * without a database lookup, and serials should not jump around.
 */
final class AccountNumberGenerator
{
    private const SERIAL_WIDTH = 7;

    public function next(AccountTypeEnum $type, string $branchCode): string
    {
        $typeCode = $this->typeCode($type);

        return DB::transaction(function () use ($typeCode, $branchCode): string {

            $lastSerial = Account::whereLike("account_number", "{$branchCode}-{$typeCode}-%")
                ->lockForUpdate()
                ->orderByDesc("account_number")
                ->value("account_number");


            $nextSerial = $lastSerial
                ? ((int) substr($lastSerial, -self::SERIAL_WIDTH)) + 1
                : 1;

            $padded = str_pad((string) $nextSerial, self::SERIAL_WIDTH, "0", STR_PAD_LEFT);

            return "{$branchCode}-{$typeCode}-{$padded}";
        });
    }



    /**
     * Two-digit type code. Keep these stable once assigned — they're
     * embedded in every account number ever issued for that type.
     */
    private function typeCode(AccountTypeEnum $type): string
    {
        return match ($type) {
            AccountTypeEnum::Savings         => '10',
            AccountTypeEnum::Current         => '20',
            AccountTypeEnum::FixedDeposit    => '30',
            AccountTypeEnum::LoanFloat       => '90',
            AccountTypeEnum::InterestIncome  => '91',
            AccountTypeEnum::CashTill        => '92',
            AccountTypeEnum::MomoFloat       => '93',
        };
    }
}
