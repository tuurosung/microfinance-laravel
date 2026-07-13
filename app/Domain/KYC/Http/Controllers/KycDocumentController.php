<?php

namespace App\Domain\KYC\Http\Controllers;

use App\Domain\CIFs\Models\Cif;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kyc\Documents\StoreKycDocumentRequest;
use App\Http\Requests\Kyc\Documents\UpdateKycDocumentRequest;
use App\Models\Kyc\KycDocument;

class KycDocumentController extends Controller
{

    public function __construct(
        private KycDocument $kycDocument
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKycDocumentRequest $request, Cif $cif)
    {
        $data = $request->validatedDocumentData();

        if ($cif->kyc->kycDocuments()->create($data)) {
            return redirect()->back()->with('success', 'Document uploaded successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KycDocument $kycDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KycDocument $kycDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKycDocumentRequest $request, KycDocument $kycDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KycDocument $kycDocument)
    {
        if ($kycDocument->delete()) {
            return redirect()->back()->with('success', 'Document deleted successfully');
        } else {
            return redirect()->back()->withErrors(['Failed to delete document']);
        }
    }
}
