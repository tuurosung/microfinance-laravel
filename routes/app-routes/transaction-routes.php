<?php

use App\Domain\Transactions\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('transactions')
    ->name('transactions.')
    ->group(function () {

        Route::post('deposit/{account}', [TransactionController::class, 'deposit'])->name('deposit');
        Route::post("widthdrawal/{account}", [TransactionController::class,"withdraw"])->name("withdrawal");

    });
