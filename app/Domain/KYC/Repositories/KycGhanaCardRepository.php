<?php

namespace App\Domain\KYC\Repositories;

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Contracts\KycGhanaCardRepositoryInterface;
use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Models\KycGhanaCard;

class KycGhanaCardRepository implements KycGhanaCardRepositoryInterface
{
    public function __construct(
        private KycGhanaCard $model
    ){}


    public function create(Kyc $kyc, array $data): KycGhanaCard
    {
        return $kyc->ghanaCard()->updateOrCreate([
            "kyc_id"=> $kyc->kyc_id,
        ], $data);
    }

    public function update(KycGhanaCard $ghanaCard, array $data): bool
    {
        return $ghanaCard->update($data);
    }

    public function delete(KycGhanaCard $ghanaCard): bool
    {
        return $ghanaCard->delete();
    }
}
