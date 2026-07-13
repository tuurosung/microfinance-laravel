<?php

use App\Domain\CIFs\Http\Controllers\CifController;
use Illuminate\Support\Facades\Route;


Route::resource("cif", CifController::class);

