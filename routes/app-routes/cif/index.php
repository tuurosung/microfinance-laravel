<?php

use Illuminate\Support\Facades\Route;


Route::prefix('cif')
    ->name('cif.')
    ->group(function () {

        require __DIR__ . '/cif-routes.php';
        require __DIR__ . '/kyc-routes.php';
    });
