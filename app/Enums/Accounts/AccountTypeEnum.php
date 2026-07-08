<?php

namespace App\Enums\Accounts;

use App\Concerns\System\InteractWithEnums;

enum AccountTypeEnum: string
{

    use InteractWithEnums;

    case Susu = "susu";
    case Savings = 'savings';
    case Current = 'current';
    case FixedDeposit = 'fixed_deposit';
    case LoanFloat = 'loan_float';
    case InterestIncome = 'interest_income';
    case CashTill = 'cash_till';
    case MomoFloat = 'momo_float';


    /**
     * System accounts have no owning CIF — cash_till, loan_float,
     * interest_income, momo_float. Customer-facing types (savings,
     * current, fixed_deposit) always belong to a CIF.
     */
    public function isSystemAccount(): bool
    {
        return match ($this) {
            self::Savings, self::Current, self::FixedDeposit => false,
            default => true,
        };
    }


    /**
     * Summary of systemTypes
     * @return AccountTypeEnum[]
     */
    public static function systemTypes(): array
    {
        return array_filter(self::cases(), fn (self $type) => $type->isSystemAccount());
    }


    public function glCode(): string
    {
        return match ($this) {
            self::Savings => '2110',
            self::Current => '2120',
            self::FixedDeposit => '2130',
            self::Susu => '2140',
            self::LoanFloat => '1210',
            self::InterestIncome  => '4100',
            self::CashTill => '1110',
            self::MomoFloat => throw new \LogicException('MomoFloat requires a provider — use MomoProviderEnum::floatGlCode().'),
        };
    }
}
