<?php

namespace App\Domain\CIFs\Http\Controllers;

use App\Domain\CIFs\Http\Requests\StoreCifRequest;
use App\Domain\CIFs\Http\Requests\UpdateCifRequest;
use App\Domain\CIFs\Models\Cif;
use App\Domain\CIFs\Services\CifService;
use App\Enums\Cif\SexOptions;
use App\Enums\Cif\TitleOptionsEnum;
use App\Http\Controllers\Controller;

class CifController extends Controller
{
    public function __construct(
        private CifService $cifService,
        private Cif $cif,
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.cif.index', [
            'cifs' => $this->cifService->allCifs()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.cif.create', [
            'sexOptions' => SexOptions::options(),
            'titleOptions' => TitleOptionsEnum::options(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCifRequest $request)
    {
        $reference = $this->cifService->createNew(
            $request->toData()
        );

        return redirect()->back()->with('success', "Customer File created successfully. {$reference}");
    }

    /**
     * Display the specified resource.
     */
    public function show(Cif $cif)
    {
        return view('app.cif.show', [
            'cif' => $cif,
            'kyc' => $cif->kyc
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cif $cif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCifRequest $request, Cif $cif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cif $cif)
    {
        //
    }
}
