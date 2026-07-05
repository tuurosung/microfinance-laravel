<?php

namespace App\Enums\Accounts;

enum GlTypeEnum: string
{
    case Asset = "asset";
    case Liability = "liability";
    case Income = "income";
    case Expense = "expense";


    /**
     * Debit-normal accounts increase with debits (assets, expenses).
     * Credit-normal accounts increase with credits (liabilities, income).
     */
    public function isDebitNormal(): bool
    {
        return match ($this) {
            self::Asset, self::Expense => true,
            self::Liability, self::Income => false,
        };
    }
}
