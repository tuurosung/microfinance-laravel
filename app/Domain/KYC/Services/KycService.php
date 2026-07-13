<?php

namespace App\Domain\KYC\Services;

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Contracts\KycRepositoryInterface;
use App\Domain\KYC\Contracts\KycServiceInterface;
use App\DTOs\Kycs\KycData;

final class KycService implements KycServiceInterface
{
    public function __construct(
        private readonly KycRepositoryInterface $kycs
    ){}


    public function updateKycInfo(Cif $cif, KycData $kycData): string
    {
        $kyc = $this->kycs->updateKyc($cif, $kycData);
        return $kyc->kyc_id;
    }

}
