<?php

namespace App\Domain\KYC\Http\Controllers;

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Models\KycAml;
use App\Domain\KYC\Services\KycService;
use App\Domain\KYC\Services\VerificationService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class VerifyKycController extends Controller
{

    public function __construct(
        private KycService $kycService,
        private VerificationService $verificationService
    ){}


    /**
     * Handle the incoming request.
     */
    public function __invoke(Cif $cif)
    {
        Log::info("Initiasing Verfication");

        $this->passCif($cif);
        $this->passKyc($cif->kyc);
        $this->passKycAml($cif->kyc->kycAml);

    }

    protected function passCif(Cif $cif): void
    {
        $checksum =$this->verificationService->compute($cif);
        $cif->persistChecksum($checksum);
    }

    protected function passKyc(Kyc $kyc): void
    {
        $checksum = $this->verificationService->compute($kyc);
        $kyc->persistChecksum($checksum);
    }


    protected function passKycAml(KycAml $kycAml): void
    {
        $checksum = $this->verificationService->compute($kycAml);
        $kycAml->persistChecksum($checksum);
    }
}
