<?php

namespace App\Enums\Accounts;

use App\Concerns\System\InteractWithEnums;

enum AccountStatusEnum: string
{
    use InteractWithEnums;


    case ACTIVE = 'active';
    case DORMANT = 'dormant';
    case SUSPENDED = 'suspended';
    case CLOSED = 'closed';

}
