<?php

namespace App\Domain\KYC\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKycWorkflowStepRequest;
use App\Http\Requests\UpdateKycWorkflowStepRequest;
use App\Models\Cif\KycWorkflowStep;

class KycWorkflowStepController extends Controller
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
    public function store(StoreKycWorkflowStepRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KycWorkflowStep $kycWorkflowStep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KycWorkflowStep $kycWorkflowStep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKycWorkflowStepRequest $request, KycWorkflowStep $kycWorkflowStep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KycWorkflowStep $kycWorkflowStep)
    {
        //
    }
}
