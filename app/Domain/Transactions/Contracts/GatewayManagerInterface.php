<?php

declare(strict_types = 1);

namespace App\Domain\Transactions\Contracts;

use App\Domain\Transactions\Contracts\GatewayInterface;
use App\Enums\Transactions\MomoProviderEnum;

interface GatewayManagerInterface
{
    public function for(MomoProviderEnum $momoProvider): GatewayInterface;
}
