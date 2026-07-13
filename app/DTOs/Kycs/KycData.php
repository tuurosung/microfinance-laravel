<?php

declare(strict_types= 1);

namespace App\DTOs\Kycs;

use App\Concerns\ArrayableDTO;

final readonly class KycData
{

    use ArrayableDTO;


    public function __construct(
        public string $region,
        public string $district,
        public string $town,
        public string $digitalAddress
    ){}


    public static function fromArray(array $data): self
    {
        return new self(
            $data["region"],
            $data["district"],
            $data["town"],
            $data["digital_address"],
        );
    }
}
