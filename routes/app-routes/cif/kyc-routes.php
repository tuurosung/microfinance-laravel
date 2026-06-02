<?php

use App\Http\Controllers\Cif\KycController;
use App\Http\Controllers\Kyc\ShowAmlStepController;
use App\Http\Controllers\Kyc\ShowDocumentsStepController;
use App\Http\Controllers\Kyc\ShowGhanaCardStepController;
use App\Http\Controllers\KycAmlController;
use App\Http\Controllers\KycDocumentController;
use App\Http\Controllers\KycGhanaCardController;
use Illuminate\Support\Facades\Route;

Route::prefix('kyc')
    ->name('kyc.')
    ->group(function () {


        // Contact Information Routes
        Route::controller(KycController::class)
            ->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/create/{cif}', 'create')->name('create');
            Route::post('/store/{cif}', 'store')->name('store');
            Route::get('/show/{kyc}', 'show')->name('show');
            Route::get('/edit/{kyc}', 'edit')->name('edit');
            Route::patch('/update/{kyc}', 'update')->name('update');
            Route::post('/destroy/{kyc}', 'destroy')->name('delete');

        });


        // show AML Step
        Route::get('/aml-step/{cif}', ShowAmlStepController::class)->name('aml-step');


        Route::prefix('aml')
            ->name('aml.')
            ->controller(KycAmlController::class)
            ->group(function () {

                Route::post('/store/{cif}', 'store')->name('store');
            });

        // Show Ghana Card Step
        Route::get('/ghana-card-step/{cif}', ShowGhanaCardStepController::class)->name('ghana-card-step');

        // Ghana Card Details
        Route::prefix('ghana-card')
            ->name('ghana-card.')
            ->controller(KycGhanaCardController::class)
            ->group(function () {

                Route::post('/store/{cif}', 'store')->name('store');
            });


        // Documents Step
        Route::get('/documents-step/{cif}', ShowDocumentsStepController::class)->name('documents-step');

        // Documents Routes
        Route::prefix('documents')
            ->name('documents.')
            ->controller(KycDocumentController::class)
            ->group(function () {

                Route::post('/store/{cif}', 'store')->name('store');
                Route::delete('/delete/{kycDocument}', 'destroy')->name('delete');

        });
});
