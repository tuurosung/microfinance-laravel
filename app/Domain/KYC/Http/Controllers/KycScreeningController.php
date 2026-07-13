<?php

namespace App\Domain\KYC\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKycScreeningRequest;
use App\Http\Requests\UpdateKycScreeningRequest;
use App\Models\Cif\KycScreening;

class KycScreeningController extends Controller
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
    public function store(StoreKycScreeningRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KycScreening $kycScreening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KycScreening $kycScreening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKycScreeningRequest $request, KycScreening $kycScreening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KycScreening $kycScreening)
    {
        //
    }
}
