<?php

namespace App\Domain\Accounts\Http\Controllers;

use App\Domain\Accounts\Http\Requests\AccountTypes\StoreAccountTypeRequest;
use App\Domain\Accounts\Http\Requests\AccountTypes\UpdateAccountTypeRequest;
use App\Domain\Accounts\Models\AccountType;
use App\Http\Controllers\Controller;

class AccountTypeController extends Controller
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
    public function store(StoreAccountTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountType $accountType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountType $accountType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountTypeRequest $request, AccountType $accountType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountType $accountType)
    {
        //
    }
}
