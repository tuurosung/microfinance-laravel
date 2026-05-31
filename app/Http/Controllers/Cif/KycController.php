<?php

namespace App\Http\Controllers\Cif;

use App\Enums\Kyc\EmploymentStatus;
use App\Enums\Kyc\EmploymentStatusEnum;
use App\Enums\Kyc\GhanaCardStatus;
use App\Enums\Kyc\GhanaCardStatusEnum;
use App\Enums\Kyc\SourceOfFunds;
use App\Enums\Kyc\SourceOfFundsEnum;
use App\Exceptions\RecordLockedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cif\Kyc\StoreKycRequest;
use App\Http\Requests\Cif\Kyc\UpdateKycRequest;
use App\Models\Cif\Cif;
use App\Models\Cif\Kyc;
use App\Services\Kyc\RegionService;

class KycController extends Controller
{
    public function __construct(
        protected Cif $cif,
        protected Kyc $kyc,
        protected RegionService $regionService
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
    public function create(Cif $cif, RegionService $regionService)
    {
        return view('app.cif.kyc-compliance', [
            'cif' => $cif,
            'ghanaCardStatus' => GhanaCardStatusEnum::options(),
            'regions' => $regionService->getRegions()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKycRequest $request, Cif $cif)
    {
        if ($cif->kyc()->updateOrCreate($request->validated())) {
            return redirect()->route('cif.kyc.aml-step', $cif);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kyc $kyc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kyc $kyc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKycRequest $request, Kyc $kyc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kyc $kyc)
    {
        //
    }
}
