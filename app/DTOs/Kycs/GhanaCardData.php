<?php

declare(strict_types= 1);

namespace App\DTOs\Kycs;

use App\Enums\Kyc\GhanaCardStatusEnum;

final readonly class GhanaCardData
{
    public function __construct(
        public GhanaCardStatusEnum $cardStatus,
        public string $cardNumber
    ){}


    public static function fromArray(array $cardData): self
    {
        return new self(
            $cardData["card_status"],
            $cardData["card_number"],
        );
    }
}
