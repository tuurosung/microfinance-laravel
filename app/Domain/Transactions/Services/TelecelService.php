<?php

declare(strict_types=1);

namespace App\Domain\Transactions\Services;

use App\Domain\Transactions\Contracts\GatewayInterface;
use App\DTOs\Gateway\MomoCollectionData;
use App\DTOs\Gateway\GatewayResult;
use App\DTOs\Gateway\MomoDisbursementData;
use App\DTOs\Gateway\WebhookEvent;

final class TelecelService implements GatewayInterface
{
    public function requestToPay(MomoCollectionData $data): GatewayResult
    {
        // TODO: Telecel Cash collections integration.
        throw new \RuntimeException('Telecel Cash Collections integration not implemented.');
    }


    public function transfer(MomoDisbursementData $data): GatewayResult
    {
        // TODO: Telecel Cash disbursements integration.
        throw new \RuntimeException('Telecel Cash Disbursements integration not implemented.');
    }


    public function parseWebhook(array $payload, array $headers): WebhookEvent
    {
        // TODO: verify Telecel callback signature.
        throw new \RuntimeException('Telecel Cash webhook parsing not implemented.');
    }
}
