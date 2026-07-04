<?php

namespace App\Domain\Accounts\Http\Controllers;

use App\Domain\Accounts\Http\Requests\StoreAccountRequest;
use App\Domain\Accounts\Models\Account;
use App\Enums\Accounts\AccountMandateEnum;
use App\Enums\Accounts\AccountTypeEnum;
use App\Http\Controllers\Controller;
use App\Services\Accounts\OpenAccountHandler;

class AccountController extends Controller
{
    public function __construct(
        protected OpenAccountHandler $openAccountHandler
    ){}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO Defer to service for fetching records

        return view('app.accounts.index', [
            'accounts'=> Account::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accountOpeningSession = $this->openAccountHandler->createSession(auth()->id());

        return view('app.accounts.accounts.create', [
            'accountTypes' => AccountTypeEnum::options(),
            'mandateTypes' => AccountMandateEnum::options(),
            'accountOpeningSession' => $accountOpeningSession,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $data = $request->validated();

        // dd($data);

        Account::create($data);

        return redirect()->back()->with('success', 'Account created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return view('app.accounts.accounts.view-account', [
            "account" => $account
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}
