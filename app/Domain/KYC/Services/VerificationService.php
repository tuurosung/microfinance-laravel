<?php

namespace App\Domain\KYC\Services;

use App\Domain\KYC\Contracts\VerificationInterface;
use App\Domain\KYC\Models\Kyc;
use Illuminate\Database\Eloquent\Model;


class VerificationService implements VerificationInterface
{
    protected string $token;

    public function __construct()
    {
        $this->token = config("mycro.vault.hash_salt");
    }


    public function compute(Model $model): string
    {
        return hash_hmac('sha256', $model->getChecksumPayload(), $this->token);
    }

    public function verify(Model $model): bool
    {
        return hash_equals($model->check_sum, $this->compute($model));
    }


    public function computeMasterChecksum(Kyc $kyc): string
    {
        $composite = collect([
            $kyc->check_sum,
            $kyc->kycAml->check_sum,
            $kyc->kycGhanaCard->check_sum,
            $kyc->kycDocuments->check_sum
        ])->implode('|');

        return hash_hmac('sha256', $composite, $this->token);
    }


    public function verifyMasterChecksum(Kyc $kyc): string
    {
        return hash_equals($kyc->master_check_sum, $this->computeMasterChecksum($kyc));
    }
}
