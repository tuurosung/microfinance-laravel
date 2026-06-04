<?php

namespace App\Enums\Accounts;

use App\Concerns\System\InteractWithEnums;

enum AccountTypeEnum: string
{

    use InteractWithEnums;

    case SUSU = 'susu';
    case SAVINGS = 'savings';
    case CURRENT = 'current';
    case CORPORATE = 'corporate';
    case BUSINESS = 'business';
}
