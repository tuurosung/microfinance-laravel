<?php

use App\Http\Controllers\Cif\KycController;
use Illuminate\Support\Facades\Route;

Route::prefix('kyc')
    ->name('kyc.')
    ->controller(KycController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create/{cif}', 'create')->name('create');
        Route::post('/store/{cif}', 'store')->name('store');
        Route::get('/show/{kyc}', 'show')->name('show');
        Route::get('/edit/{kyc}', 'edit')->name('edit');
        Route::patch('/update/{kyc}', 'update')->name('update');
        Route::post('/destroy/{kyc}', 'destroy')->name('delete');

});
