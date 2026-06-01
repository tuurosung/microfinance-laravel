<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kyc\GhanaCard\StoreKycGhanaCardRequest;
use App\Http\Requests\UpdateKycGhanaCardRequest;
use App\Models\Cif\Cif;
use App\Models\Cif\KycGhanaCard;

class KycGhanaCardController extends Controller
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
    public function store(StoreKycGhanaCardRequest $request, Cif $cif)
    {
        if ($cif->kyc->ghanaCard()->create($request->validated())) {
            return redirect()->back()->with('success', "Ghana Card Updated Successfully");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KycGhanaCard $kycGhanaCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KycGhanaCard $kycGhanaCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKycGhanaCardRequest $request, KycGhanaCard $kycGhanaCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KycGhanaCard $kycGhanaCard)
    {
        //
    }
}
