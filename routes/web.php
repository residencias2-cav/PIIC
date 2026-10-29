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

Route::resource('catalogos/inf_credito', InfCreditoController::class)
    ->names('inf_credito');
Route::resource('catalogos/producto_servicio', ProductoServicioController::class)
    ->names('producto_servicio');



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

Route::get('/catalogos/gerencia',[GerenciaController::class, 'vistaIndex'])
    ->name('gerencia.index');
Route::get('/catalogos/gerencia/create',[GerenciaController::class, 'vistaCreate'])
    ->name('gerencia.create');
Route::get('/catalogos/gerencia/{gerencia}/edit',[GerenciaController::class, 'vistaEdit'])
    ->name('gerencia.edit');

Route::get('/catalogos/ubicacion',[UbicacionController::class, 'vistaIndex'])
    ->name('ubicacion.index');
Route::get('/catalogos/ubicacion/create',[UbicacionController::class, 'vistaCreate'])
    ->name('ubicacion.create');
Route::get('/catalogos/ubicacion/{ubicacion}/edit',[UbicacionController::class, 'vistaEdit'])
    ->name('ubicacion.edit');

Route::get('/catalogos/proyecto',[ProyectoController::class, 'vistaIndex'])
    ->name('proyecto.index');
Route::get('/catalogos/proyecto/create',[ProyectoController::class, 'vistaCreate'])
    ->name('proyecto.create');
Route::get('/catalogos/proyecto/{proyecto}/edit',[ProyectoController::class, 'vistaEdit'])
    ->name('proyecto.edit');

Route::get('/catalogos/obra',[ObraController::class, 'vistaIndex'])
    ->name('obra.index');
Route::get('/catalogos/obra/create',[ObraController::class, 'vistaCreate'])
    ->name('obra.create');
Route::get('/catalogos/obra/{obra}/edit',[ObraController::class, 'vistaEdit'])
    ->name('obra.edit');

Route::get('/catalogos/inf_contrato',[InfContratoController::class, 'vistaIndex'])
    ->name('inf_contrato.index');
Route::get('/catalogos/inf_contrato/create',[InfContratoController::class, 'vistaCreate'])
    ->name('inf_contrato.create');
Route::get('/catalogos/inf_contrato/{inf_contrato}/edit',[InfContratoController::class, 'vistaEdit'])
    ->name('inf_contrato.edit');
