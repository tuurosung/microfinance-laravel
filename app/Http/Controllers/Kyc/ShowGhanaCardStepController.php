<?php

namespace App\Http\Controllers\Kyc;

use App\Enums\Kyc\GhanaCardStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Cif\Cif;

class ShowGhanaCardStepController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Cif $cif)
    {
        return view('app.kyc.ghana-card-step', [
            'cif' => $cif,
            'ghanaCardStatus' => GhanaCardStatusEnum::options(),
        ]);
    }
}
