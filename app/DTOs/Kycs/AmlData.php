<?php

declare (strict_types= 1);

namespace App\DTOs\Kycs;

use App\Concerns\ArrayableDTO;
use App\Enums\Kyc\EmploymentStatusEnum;
use App\Enums\Kyc\SourceOfFundsEnum;

final readonly class AmlData
{
    use ArrayableDTO;

    public function __construct(
        public SourceOfFundsEnum $sourceOfFunds,
        public EmploymentStatusEnum $employmentStatus,
        public string $occupation,
        public string $employerName,
        public int $monthlyIncome
    ){}


    public static function fromArray(array $data): self
    {
        return new self(
            $data["source_of_funds"],
            $data["employment_status"],
            $data["occupation"],
            $data["employer_name"],
            (int) $data["monthly_income"],
        );
    }
}
