<?php

declare(strict_types= 1);

namespace App\Domain\KYC\Contracts;

use App\Domain\CIFs\Models\Cif;
use App\DTOs\Kycs\KycData;

interface KycServiceInterface
{
    public function updateKycInfo(Cif $cif, KycData $kycData): string;

}
