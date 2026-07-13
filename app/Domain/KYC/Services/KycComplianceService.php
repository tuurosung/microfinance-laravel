<?php

declare (strict_types= 1);

namespace App\Domain\KYC\Services;

use App\Domain\KYC\Contracts\KycComplianceInterface;
use App\Domain\KYC\Models\Kyc;
use App\DTOs\Kycs\AmlData;
use App\DTOs\Kycs\GhanaCardData;
use App\DTOs\Kycs\KycData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class KycComplianceService implements KycComplianceInterface
{

    public function updateContact(Kyc $kyc, KycData $kycData): bool
    {
        return DB::transaction(function () use ($kyc, $kycData){

            $isUpdated = $kyc->update($kycData->toArray());

            if (! $isUpdated) {
                throw new \DomainException("Unable to update Contact Information");
            }

            Log::info("Updated Successfully", [$isUpdated]);

            return true;
        });
    }


    public function updateAml(Kyc $kyc, AmlData $amlData): bool
    {
        return DB::transaction(function () use ($kyc, $amlData){

            Log::info("KYC Updated", [$kyc]);

            $isUpdated = $kyc->kycAml()->updateOrCreate([
                "kyc_id"=> $kyc->kyc_id
                ], $amlData->toArray()
            );

            if (! $isUpdated) {
                throw new \DomainException("Unable to update AML Information");
            }

            Log::info("AML Information Updated Successfully", [$isUpdated]);

            return true;
        });
    }


    public function updateGhanaCard(Kyc $kyc, GhanaCardData $ghanaCardData): bool
    {
        return DB::transaction(function () use ($kyc, $ghanaCardData){
            return true;
        });
    }

}
