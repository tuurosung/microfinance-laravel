<?php

namespace App\Domain\KYC\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKycIntegrationResponseRequest;
use App\Http\Requests\UpdateKycIntegrationResponseRequest;
use App\Models\Cif\KycIntegrationResponse;

class KycIntegrationResponseController extends Controller
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
    public function store(StoreKycIntegrationResponseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KycIntegrationResponse $kycIntegrationResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KycIntegrationResponse $kycIntegrationResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKycIntegrationResponseRequest $request, KycIntegrationResponse $kycIntegrationResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KycIntegrationResponse $kycIntegrationResponse)
    {
        //
    }
}
