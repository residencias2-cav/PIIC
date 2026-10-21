<?php

use illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ArticuloController,
    GerenciaController,
    ProyectoController};

use App\Models\{
    Gerencia,
    Proyecto,
    Lugar,
    Ubicacion,

};

Route::prefix('catalogos')->group(function () {
    Route::apiResource('articulos', ArticuloController::class);
    Route::apiResource('gerencia', GerenciaController::class);
    Route::apiResource('proyecto', ProyectoController::class);
    
});