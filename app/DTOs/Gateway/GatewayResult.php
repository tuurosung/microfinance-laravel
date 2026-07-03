<?php

declare(strict_types = 1);

namespace App\DTOs\Gateway;

final readonly class GatewayResult
{
    public function __construct(
        public bool $accepted,
        public ?string $providerReference = null,
        public ?string $message = null,
    ){}
}
