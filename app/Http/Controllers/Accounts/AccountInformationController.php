<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\DepositAccounts\StoreInitialAccountInformationRequest;
use App\Services\Accounts\OpenAccountHandler;

class AccountInformationController extends Controller
{
    public function __construct(
        private OpenAccountHandler $openAccountHandler
    ){}


    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreInitialAccountInformationRequest $request)
    {
       $data = $request->validated();
       $userIdentifier = auth()->id();

       try {
            $this->openAccountHandler->storeAccountData($userIdentifier, $data);
        } catch (\RuntimeException $exception) {
            return back()->withErrors($exception->getMessage());
        }

        // dd($this->openAccountHandler->getAccountData($userIdentifier)->toArray());
        // return to_route('accounts.deposit-accounts.add-cifs');
        return redirect()->route('accounts.deposit-accounts.add-cifs');


    }
}
