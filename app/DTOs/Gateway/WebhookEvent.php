<?php

declare(strict_types=1);

namespace App\DTOs\Gateway;

final readonly class WebhookEvent
{
    public function __construct(
        public string $providerReference,
        public bool $success,
        public array $raw,
        public ?string $failureReason = null,
    ){}
}