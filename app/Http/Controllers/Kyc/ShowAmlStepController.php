<?php

namespace App\Http\Controllers\Kyc;

use App\Enums\Kyc\EmploymentStatusEnum;
use App\Enums\Kyc\SourceOfFundsEnum;
use App\Http\Controllers\Controller;
use App\Models\Cif\Cif;

class ShowAmlStepController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Cif $cif)
    {
        return view('app.kyc.aml-step', [
            'cif' => $cif,
            'sourceOfFunds' => SourceOfFundsEnum::options(),
            'employmentStatus' => EmploymentStatusEnum::options(),
        ]);
    }
}
