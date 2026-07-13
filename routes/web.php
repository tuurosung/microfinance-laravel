<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');



    require __DIR__.'/app-routes/cif-routes.php';
    require __DIR__.'/app-routes/kyc-routes.php';
    require __DIR__.'/app-routes/account-routes.php';
    require __DIR__.'/app-routes/transaction-routes.php';

});

require __DIR__.'/settings.php';
