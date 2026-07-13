<?php

namespace App\Domain\KYC\Contracts;

use App\Domain\KYC\Models\Kyc;
use Illuminate\Database\Eloquent\Model;

interface VerificationInterface
{
    public function compute(Model $model): string;
    public function verify(Model $model): bool;
    public function computeMasterChecksum(Kyc $kyc): string;
    public function verifyMasterChecksum(Kyc $kyc): string;
}
