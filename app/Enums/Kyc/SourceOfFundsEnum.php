<?php

namespace App\Enums\Kyc;

use App\Concerns\EnumTrait;

enum SourceOfFundsEnum: string
{

    use EnumTrait;

    case SALARY = 'salary';
    case BUSINESS_INCOME = 'business_income';
    case INVESTMENT = 'investment';
    case INHERITANCE = 'inheritance';
    case GIFT = 'gift';
    case PENSION = 'pension';
    case OTHER = 'other';

}
