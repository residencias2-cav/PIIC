<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Catalogos\ArticuloController;
use App\Http\Controllers\Catalogos\EmpresaController;
use App\Http\Controllers\Catalogos\InfContratoController;
use App\Http\Controllers\Catalogos\InfCreditoController;
use App\Http\Controllers\Catalogos\LugarController;
use App\Http\Controllers\Catalogos\ObraController;
use App\Http\Controllers\Catalogos\ProductoServicioController;
use App\Http\Controllers\Catalogos\ProyectoController;
use App\Http\Controllers\Catalogos\UnidadController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('catalogos/articulo', ArticuloController::class)
    ->names('articulo');
Route::resource('catalogos/empresa', EmpresaController::class)
    ->names('empresa');
Route::resource('catalogos/inf_contrato',InfContratoController::class)
    ->names('inf_contrato');
Route::resource('catalogos/inf_credito', InfCreditoController::class)
    ->names('inf_credito');
Route::resource('catalogos/lugar', LugarController::class)
    ->names('lugar');
Route::resource('catalogos/obra', ObraController::class)
    ->names('obra');
Route::resource('catalogos/producto_servicio', ProductoServicioController::class)
    ->names('producto_servicio');
Route::resource('catalogos/proyecto', ProyectoController::class)
    ->names('proyecto');
Route::resource('catalogos/unidad', UnidadController::class)
    ->names('unidad');
