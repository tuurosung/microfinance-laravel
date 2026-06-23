<?php

namespace App\Domain\KYC\Services;

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Contracts\KycGhanaCardRepositoryInterface;
use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Models\KycGhanaCard;
use Illuminate\Support\Facades\Log;

class KycGhanaCardService
{
    public function __construct(
        private KycGhanaCardRepositoryInterface $ghanaCard
    ){}


    public function saveGhanaCard(Kyc $kyc, array $data): KycGhanaCard
    {
        Log::info($data);
        $cardRecord = $this->ghanaCard->create($kyc, $data);

        if (! $cardRecord) {
            throw new \Exception("Unable to update Ghana Card records");
        }

        Log::info("Records updated successfully");

        return $cardRecord;
    }

}
