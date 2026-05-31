<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kyc\Aml\StoreKycAmlRequest;
use App\Http\Requests\Kyc\Aml\UpdateKycAmlRequest;
use App\Models\Cif\Cif;
use App\Models\Cif\KycAml;

class KycAmlController extends Controller
{
    public function __construct(
        private KycAml $kycAml
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
    public function store(StoreKycAmlRequest $request, Cif $cif)
    {
        if ($cif->kyc->kycAml()->updateOrCreate($request->validated())) {
            return redirect()->back()->with('success', 'AML information recorded successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KycAml $kycAml)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KycAml $kycAml)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKycAmlRequest $request, KycAml $kycAml)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KycAml $kycAml)
    {
        //
    }
}
