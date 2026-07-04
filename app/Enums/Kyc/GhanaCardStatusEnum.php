<?php

namespace App\Enums\Kyc;

use App\Concerns\EnumTrait;

enum GhanaCardStatusEnum: string
{
    use EnumTrait;
    
    case NOT_PRESENT = 'not_present';
    case PRESENT = 'present';


}
