<?php

namespace App\Domain\KYC\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKycConsentRequest;
use App\Http\Requests\UpdateKycConsentRequest;
use App\Models\Cif\KycConsent;

class KycConsentController extends Controller
{
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
    public function store(StoreKycConsentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KycConsent $kycConsent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KycConsent $kycConsent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKycConsentRequest $request, KycConsent $kycConsent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KycConsent $kycConsent)
    {
        //
    }
}
