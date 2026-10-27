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
use App\Http\Controllers\Catalogos\UbicacionController;
use App\Http\Controllers\Catalogos\GerenciaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('catalogos/inf_contrato',InfContratoController::class)
    ->names('inf_contrato');
Route::resource('catalogos/inf_credito', InfCreditoController::class)
    ->names('inf_credito');
Route::resource('catalogos/obra', ObraController::class)
    ->names('obra');
Route::resource('catalogos/producto_servicio', ProductoServicioController::class)
    ->names('producto_servicio');
Route::resource('catalogos/proyecto', ProyectoController::class)
    ->names('proyecto');
Route::resource('catalogos/ubicacion', UbicacionController::class)
    ->names('ubicacion');
Route::resource('catalogos/gerencia', GerenciaController::class)
    ->names('gerencia');

Route::get('/catalogos/articulo',[ArticuloController::class, 'vistaIndex'])
    ->name('articulo.index');
Route::get('/catalogos/articulo/create',[ArticuloController::class, 'vistaCreate'])
    ->name('articulo.create');
Route::get('/catalogos/articulo/{articulo}/edit',[ArticuloController::class, 'vistaEdit'])
    ->name('articulo.edit');

Route::get('/catalogos/empresa',[EmpresaController::class, 'vistaIndex'])
    ->name('empresa.index');
Route::get('/catalogos/empresa/create',[EmpresaController::class, 'vistaCreate'])
    ->name('empresa.create');
Route::get('/catalogos/empresa/{empresa}/edit',[EmpresaController::class, 'vistaEdit'])
    ->name('empresa.edit');

Route::get('/catalogos/lugar',[LugarController::class, 'vistaIndex'])
    ->name('lugar.index');
Route::get('/catalogos/lugar/create',[LugarController::class, 'vistaCreate'])
    ->name('lugar.create');
Route::get('/catalogos/lugar/{lugar}/edit',[LugarController::class, 'vistaEdit'])
    ->name('lugar.edit');
