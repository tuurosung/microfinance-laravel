<?php

namespace App\Domain\KYC\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKycBiometricsRequest;
use App\Http\Requests\UpdateKycBiometricsRequest;
use App\Models\Cif\KycBiometrics;

class KycBiometricsController extends Controller
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
    public function store(StoreKycBiometricsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KycBiometrics $kycBiometrics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KycBiometrics $kycBiometrics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKycBiometricsRequest $request, KycBiometrics $kycBiometrics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KycBiometrics $kycBiometrics)
    {
        //
    }
}
