<?php

namespace App\Domain\KYC\Contracts;

use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Models\KycGhanaCard;

interface KycGhanaCardRepositoryInterface
{
    public function create(Kyc $kyc, array $data): KycGhanaCard;
    public function update(KycGhanaCard $ghanCard, array $data): bool;
    public function delete(KycGhanaCard $ghanaCard): bool;
}
