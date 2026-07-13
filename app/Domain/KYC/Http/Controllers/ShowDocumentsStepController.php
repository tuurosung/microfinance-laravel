<?php

namespace App\Domain\KYC\Http\Controllers;

use App\Domain\CIFs\Models\Cif;
use App\Http\Controllers\Controller;

class ShowDocumentsStepController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Cif $cif)
    {
        return view('app.kyc.documents-step', [
            'cif' => $cif,
            'lastUploadedPassportPhoto' => $this->getLastUploadedPassportPhoto($cif),
            'lastUploadedGhanaCardPhoto' => $this->getLastUploadedGhanaCardPhoto($cif)
        ]);
    }


    protected function getLastUploadedPassportPhoto(Cif $cif)
    {
        return $cif->kyc->kycDocuments()
            ->where('document_type', 'passport_photo')->first();
    }

    protected function getLastUploadedGhanaCardPhoto(Cif $cif)
    {
        return $cif->kyc->kycDocuments()
            ->where('document_type', 'ghana_card_photo')->first();
    }
}
