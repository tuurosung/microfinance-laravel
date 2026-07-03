<?php

declare(strict_types=1);

namespace App\Domain\Transactions\Contracts;

use App\DTOs\Gateway\GatewayResult;
use App\DTOs\Gateway\MomoCollectionData;
use App\DTOs\Gateway\MomoDisbursementData;
use App\DTOs\Gateway\WebhookEvent;

interface GatewayInterface
{
    /**
     * Money in: debit the customer's wallet into the MFI float (deposit).
     */
    public function requestToPay(MomoCollectionData $data): GatewayResult;


    /**
     * Money out: push from the MFI float to the customer's wallet (withdrawal).
     */
    public function transfer(MomoDisbursementData $data): GatewayResult;


    /**
     * Verify signature and normalise the provider callback.
     *
    //  * @throws \App\Exceptions\InvalidWebhookSignatureException
     */
    public function parseWebhook(array $payload, array $headers): WebhookEvent;
}
