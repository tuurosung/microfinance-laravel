<?php

declare(strict_types=1);

namespace App\DTOs\Cifs;

use App\Concerns\ArrayableDTO;
use App\Enums\Cif\SexOptions;

final readonly class CifData
{
    use ArrayableDTO;

    public function __construct(
        public string $firstName,
        public string $otherNames,
        public string $dateOfBirth,
        public SexOptions $sex,
        public string $phoneNumber,
        public string $residentialAddress,
        public ?string $email = null,
    ) {}


}
