<?php

use App\Domain\Accounts\Http\Controllers\AccountController;
use App\Domain\Accounts\Http\Controllers\AccountInformationController;
use App\Domain\Accounts\Http\Controllers\AccountTypeController;
use App\Domain\Accounts\Http\Controllers\AddCifController;
use App\Domain\Accounts\Http\Controllers\AssociateCifController;
use Illuminate\Support\Facades\Route;

Route::prefix("deposit-accounts")
    ->name("deposit-accounts")
    ->group(function () {

        Route::post('/initialise', AccountInformationController::class)->name('initialise');
        Route::get('add-cifs', AddCifController::class)->name('add-cifs');
        Route::post('assoc-cif', AssociateCifController::class)->name('assoc-cif');
    });

Route::resources([
    "accounts"=> AccountController::class
]);

// Account-type routes
Route::resource('account-types', AccountTypeController::class);
Route::resource('accounts', AccountController::class);

// Route::prefix('deposit-accounts')
//     ->name('deposit-accounts.')
//     ->group(function () {

//         Route::post('store-initial-account-information', AccountInformationController::class)->name('store-initial-account-information');
//         Route::get('add-cifs', AddCifController::class)->name('add-cifs');
//         Route::post('assoc-cif', AssociateCifController::class)->name('assoc-cif');
//     });

// // Account-type routes
// Route::resource('account-types', AccountTypeController::class);
// Route::resource('deposit-accounts', DepositAccountController::class);
