<?php

declare(strict_types=1);

namespace  App\Domain\Transactions\Services;

use App\Domain\Transactions\Contracts\GatewayInterface;
use App\DTOs\Gateway\MomoCollectionData;
use App\DTOs\Gateway\GatewayResult;
use App\DTOs\Gateway\MomoDisbursementData;
use App\DTOs\Gateway\WebhookEvent;
use Override;

final class MtnMomoService implements GatewayInterface
{
    public function requestToPay(MomoCollectionData $data): GatewayResult
    {
        // TODO: MTN MoMo Collections API — POST /collection/v1_0/requesttopay
        // with X-Reference-Id = $data->externalReference, amount converted
        // from pesewas to GHS decimal string, payer.partyId = wallet msisdn.
        throw new \RuntimeException('MTN MoMo Collections integration not implemented.');
    }


    public function transfer(MomoDisbursementData $data): GatewayResult
    {
        // TODO: MTN MoMo Disbursements API — POST /disbursement/v1_0/transfer
        throw new \RuntimeException('MTN MoMo Disbursements integration not implemented.');
    }

 
    public function parseWebhook(array $payload, array $headers): WebhookEvent
    {
        // TODO: verify callback authenticity (MTN uses the referenceId you
        // supplied; validate against a stored pending transaction AND verify
        // the callback host/basic-auth per your API user config).
        throw new \RuntimeException('MTN MoMo webhook parsing not implemented.');
    }
}
