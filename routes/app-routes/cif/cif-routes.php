<?php

use App\Http\Controllers\Cif\CifController;
use Illuminate\Support\Facades\Route;

Route::controller(CifController::class)
    ->group(function (){

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{cif}', 'show')->name('show');
        Route::get('/edit/{customer}', 'edit')->name('edit');
        Route::patch('/update/{customer}', 'update')->name('update');
        Route::post('/destroy/{customer}', 'destroy')->name('delete');

    });
