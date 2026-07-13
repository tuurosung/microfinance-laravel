<?php

namespace App\Domain\KYC\Http\Controllers;

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Services\KycService;
use App\Domain\KYC\Services\RegionService;
use App\Enums\Kyc\EmploymentStatus;
use App\Enums\Kyc\EmploymentStatusEnum;
use App\Enums\Kyc\GhanaCardStatus;
use App\Enums\Kyc\GhanaCardStatusEnum;
use App\Enums\Kyc\SourceOfFunds;
use App\Enums\Kyc\SourceOfFundsEnum;
use App\Exceptions\RecordLockedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kyc\StoreKycRequest;
use App\Http\Requests\Kyc\UpdateKycRequest;
use Illuminate\Support\Facades\Log;

class KycController extends Controller
{
    public function __construct(
        private KycService $kycService,
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
            'regions' => $regionService->getRegions()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKycRequest $request, Cif $cif)
    {
        try {

            $kyc = $this->kycService->createKyc($cif, $request->validated());
            return redirect()->route('cif.kyc.aml-step', [$cif, $kyc])->with('success','Kyc Updated Successfully');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());

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
