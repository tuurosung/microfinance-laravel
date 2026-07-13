<?php

declare(strict_types= 1);

namespace App\Domain\KYC\Contracts;

use App\Domain\KYC\Models\Kyc;
use App\DTOs\Kycs\AmlData;
use App\DTOs\Kycs\GhanaCardData;
use App\DTOs\Kycs\KycData;

interface KycComplianceInterface
{
    /**
     * Update the contact information
     */
    public function updateContact(Kyc $kyc, KycData $data): bool;


    /**
     * Update AML Information
     */
    public function updateAml(Kyc $kyc, AmlData $amlData): bool;


    /**
     * Update Ghana Card Information
     */
    public function updateGhanaCard(Kyc $kyc, GhanaCardData $data): bool;
}

