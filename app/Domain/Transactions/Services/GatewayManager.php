<?php

declare(strict_types= 1);

namespace App\Domain\Transactions\Services;

use App\Domain\Transactions\Contracts\GatewayInterface;
use App\Domain\Transactions\Contracts\GatewayManagerInterface;
use App\Domain\Transactions\Services\MtnMomoService;
use App\Domain\Transactions\Services\TelecelService;
use App\Enums\Transactions\MomoProviderEnum;
use Override;

class GatewayManager implements GatewayManagerInterface
{
    #[Override]
    public function for(MomoProviderEnum $momoProvider): GatewayInterface
    {
        return match($momoProvider) {
            MomoProviderEnum::Mtn => app(MtnMomoService::class),
            MomoProviderEnum::Telecel => app(TelecelService::class),
        };
    }
}
