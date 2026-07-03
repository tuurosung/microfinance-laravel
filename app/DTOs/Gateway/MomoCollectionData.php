<?php

declare(strict_types = 1);

namespace App\DTOs\Gateway;

final readonly class MomoCollectionData
{
    public function __construct(
        public string $walletNumber,
        public int $amountPesewas,
        public string $externalReference,
        public string $narration,
    ){}
}
