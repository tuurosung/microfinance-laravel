<?php

namespace App\Http\Controllers\Cif;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cif\Cif\StoreCifRequest;
use App\Http\Requests\Cif\Cif\UpdateCifRequest;
use App\Models\Cif\Cif;

class CifController extends Controller
{
    public function __construct(
        private Cif $cif,
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.cif.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.cif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCifRequest $request)
    {
        $data = $request->validated();

        $cif = $this->cif->create($data);

        if ($cif) {
            return to_route('cif.kyc.create', $cif)->with('success', 'Cif created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cif $cif)
    {
        //
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
