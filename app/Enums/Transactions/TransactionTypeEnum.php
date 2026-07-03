<?php

namespace App\Enums\Transactions;

enum TransactionTypeEnum: string
{
    case Deposit = "deposit";
    case Withdrawal = "withdrawal";
    case LoanDisbursement = 'loan_disbursement';
    case Repayment = 'repayment';
    case Reversal = 'reversal';
    case LienHold = 'lien_hold';
    case LienRelease = 'lien_release';
    case Fee = 'fee';
    case Interest = 'interest';


    public function label(): string
    {
        return str($this->name)
            ->replace('_', ' ')
            ->title();
    }
}
