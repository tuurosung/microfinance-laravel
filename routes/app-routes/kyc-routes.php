<?php

use App\Domain\KYC\Http\Controllers\KycAmlController;
use App\Domain\KYC\Http\Controllers\KycController;
use App\Domain\KYC\Http\Controllers\KycDocumentController;
use App\Domain\KYC\Http\Controllers\KycGhanaCardController;
use App\Domain\KYC\Http\Controllers\ShowAmlStepController;
use App\Domain\KYC\Http\Controllers\ShowDocumentsStepController;
use App\Domain\KYC\Http\Controllers\ShowGhanaCardStepController;
use App\Domain\KYC\Http\Controllers\ShowKycComplianceController;
use Illuminate\Support\Facades\Route;

// #steppers
Route::prefix('cif/kyc')
    ->name('cif.kyc.')
    ->group(function () {

        Route::get('kyc-compliance/{cif}', ShowKycComplianceController::class)->name('kyc-compliance');

        // Route::get('aml-step/{cif}/{kyc}', ShowAmlStepController::class)->name('aml-step');
        // Route::get('ghana-card-step/{cif}/{kyc}', ShowGhanaCardStepController::class)->name('ghana-card-step');
        // Route::get('documents-step/{cif}', ShowDocumentsStepController::class)->name('documents-step');
    });

Route::resource("cif.kyc", KycController::class);

Route::resources([

    "cif.kyc.aml" => KycAmlController::class,
    "cif.kyc.ghana-card" => KycGhanaCardController::class,
    "cif.kyc.documents" => KycDocumentController::class,

]);



// AML Step


// Show Ghana Card Step


// Documents Step


// Documents Step


Route::prefix('kyc')
    ->name('kyc.')
    ->group(function () {


        // Contact Information Routes
        // Route::controller(KycController::class)
        //     ->group(function () {

        //     Route::get('/', 'index')->name('index');
        //     Route::get('/create/{cif}', 'create')->name('create');
        //     Route::post('/store/{cif}', 'store')->name('store');
        //     Route::get('/show/{kyc}', 'show')->name('show');
        //     Route::get('/edit/{kyc}', 'edit')->name('edit');
        //     Route::patch('/update/{kyc}', 'update')->name('update');
        //     Route::post('/destroy/{kyc}', 'destroy')->name('delete');

        // });


        // show AML Step



        // Route::prefix('aml')
        //     ->name('aml.')
        //     ->controller(KycAmlController::class)
        //     ->group(function () {

        //         Route::post('/store/{cif}', 'store')->name('store');
        //     });



        // Ghana Card Details
        // Route::prefix('ghana-card')
        //     ->name('ghana-card.')
        //     ->controller(KycGhanaCardController::class)
        //     ->group(function () {

        //         Route::post('/store/{cif}', 'store')->name('store');
        //     });




        // Documents Routes
        // Route::prefix('documents')
        //     ->name('documents.')
        //     ->controller(KycDocumentController::class)
        //     ->group(function () {

        //         Route::post('/store/{cif}', 'store')->name('store');
        //         Route::delete('/delete/{kycDocument}', 'destroy')->name('delete');

        // });
});
