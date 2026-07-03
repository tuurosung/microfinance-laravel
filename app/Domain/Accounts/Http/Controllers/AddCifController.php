<?php

namespace App\Domain\Accounts\Http\Controllers;

use App\Domain\CIFs\Services\CifService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddCifController extends Controller
{
    public function __construct(
        private CifService $cifService
    ){}


    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('app.accounts.accounts.add-cif', [
            'cifs' => $this->cifService->getCifs()
        ]);
    }
}
