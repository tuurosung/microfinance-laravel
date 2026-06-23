<?php

namespace App\Domain\KYC\Http\Controllers;

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Models\Kyc;
use App\Http\Controllers\Controller;

class ShowKycComplianceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Cif $cif)
    {
        return view('app.kyc.show-kyc-compliance', [
            'cif'=> $cif,
            'kyc' => $cif->kyc,
        ]);
    }
}
