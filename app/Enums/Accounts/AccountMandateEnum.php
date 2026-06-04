<?php

namespace App\Enums\Accounts;

use App\Concerns\System\InteractWithEnums;

enum AccountMandateEnum: string
{

    use InteractWithEnums;
    
    case SOLE = 'sole';
    case ANY_ONE = 'any_one';
    case ANY_TWO = 'any_two';
}
