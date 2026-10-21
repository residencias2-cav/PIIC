<?php

use illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;

Route::prefix('catalogos')->group(function () {
    Route::apiResource('articulos', ArticuloController::class);
});