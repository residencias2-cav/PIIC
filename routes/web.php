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

Route::get('/catalogos/articulo',[ArticuloController::class, 'vistaIndex'])
    ->name('articulo.index');
Route::get('/catalogos/articulo/create',[ArticuloController::class, 'vistaCreate'])
    ->name('articulo.create');
Route::get('/catalogos/articulo/{articulo}/edit',[ArticuloController::class, 'vistaEdit'])
    ->name('articulo.edit');
Route::post('/catalogos/articulo',[ArticuloController::class, 'store'])
    ->name('articulo.store');
Route::put('/catalogos/articulo/{articulo}',[ArticuloController::class, 'update'])
    ->name('articulo.update');
Route::delete('/catalogos/articulo/{articulo}',[ArticuloController::class, 'destroy'])
    ->name('articulo.destroy');


Route::get('/catalogos/empresa',[EmpresaController::class, 'vistaIndex'])
    ->name('empresa.index');
Route::get('/catalogos/empresa/create',[EmpresaController::class, 'vistaCreate'])
    ->name('empresa.create');
Route::get('/catalogos/empresa/{empresa}/edit',[EmpresaController::class, 'vistaEdit'])
    ->name('empresa.edit');
Route::post('/catalogos/empresa',[EmpresaController::class, 'store'])
    ->name('empresa.store');
Route::put('/catalogos/empresa/{empresa}',[EmpresaController::class, 'update'])
    ->name('empresa.update');
Route::delete('/catalogos/empresa/{empresa}',[EmpresaController::class, 'destroy'])
    ->name('empresa.destroy');


Route::get('/catalogos/lugar',[LugarController::class, 'vistaIndex'])
    ->name('lugar.index');
Route::get('/catalogos/lugar/create',[LugarController::class, 'vistaCreate'])
    ->name('lugar.create');
Route::get('/catalogos/lugar/{lugar}/edit',[LugarController::class, 'vistaEdit'])
    ->name('lugar.edit');
Route::post('/catalogos/lugar',[LugarController::class, 'store'])
    ->name('lugar.store');
Route::put('/catalogos/lugar/{lugar}',[LugarController::class, 'update'])
    ->name('lugar.update');
Route::delete('/catalogos/lugar/{lugar}',[LugarController::class, 'destroy'])
    ->name('lugar.destroy');


Route::get('/catalogos/gerencia',[GerenciaController::class, 'vistaIndex'])
    ->name('gerencia.index');
Route::get('/catalogos/gerencia/create',[GerenciaController::class, 'vistaCreate'])
    ->name('gerencia.create');
Route::get('/catalogos/gerencia/{gerencia}/edit',[GerenciaController::class, 'vistaEdit'])
    ->name('gerencia.edit');
Route::post('/catalogos/gerencia',[GerenciaController::class, 'store'])
    ->name('gerencia.store');
Route::put('/catalogos/gerencia/{gerencia}',[GerenciaController::class, 'update'])
    ->name('gerencia.update');
Route::delete('/catalogos/gerencia/{gerencia}',[GerenciaController::class, 'destroy'])
    ->name('gerencia.destroy');


Route::get('/catalogos/ubicacion',[UbicacionController::class, 'vistaIndex'])
    ->name('ubicacion.index');
Route::get('/catalogos/ubicacion/create',[UbicacionController::class, 'vistaCreate'])
    ->name('ubicacion.create');
Route::get('/catalogos/ubicacion/{ubicacion}/edit',[UbicacionController::class, 'vistaEdit'])
    ->name('ubicacion.edit');
Route::post('/catalogos/ubicacion',[UbicacionController::class, 'store'])
    ->name('ubicacion.store');
Route::put('/catalogos/ubicacion/{ubicacion}',[UbicacionController::class, 'update'])
    ->name('ubicacion.update');
Route::delete('/catalogos/ubicacion/{ubicacion}',[UbicacionController::class, 'destroy'])
    ->name('ubicacion.destroy');

Route::get('/catalogos/proyecto',[ProyectoController::class, 'vistaIndex'])
    ->name('proyecto.index');
Route::get('/catalogos/proyecto/create',[ProyectoController::class, 'vistaCreate'])
    ->name('proyecto.create');
Route::get('/catalogos/proyecto/{proyecto}/edit',[ProyectoController::class, 'vistaEdit'])
    ->name('proyecto.edit');
Route::post('/catalogos/proyecto',[ProyectoController::class, 'store'])
    ->name('proyecto.store');
Route::put('/catalogos/proyecto/{proyecto}',[ProyectoController::class, 'update'])
    ->name('proyecto.update');
Route::delete('/catalogos/proyecto/{proyecto}',[ProyectoController::class, 'destroy'])
    ->name('proyecto.destroy');


Route::get('/catalogos/obra',[ObraController::class, 'vistaIndex'])
    ->name('obra.index');
Route::get('/catalogos/obra/create',[ObraController::class, 'vistaCreate'])
    ->name('obra.create');
Route::get('/catalogos/obra/{obra}/edit',[ObraController::class, 'vistaEdit'])
    ->name('obra.edit');
Route::post('/catalogos/obra',[ObraController::class, 'store'])
    ->name('obra.store');
Route::put('/catalogos/obra/{obra}',[ObraController::class, 'update'])
    ->name('obra.update');
Route::delete('/catalogos/obra/{obra}',[ObraController::class, 'destroy'])
    ->name('obra.destroy');


Route::get('/catalogos/inf_contrato',[InfContratoController::class, 'vistaIndex'])
    ->name('inf_contrato.index');
Route::get('/catalogos/inf_contrato/create',[InfContratoController::class, 'vistaCreate'])
    ->name('inf_contrato.create');
Route::get('/catalogos/inf_contrato/{inf_contrato}/edit',[InfContratoController::class, 'vistaEdit'])
    ->name('inf_contrato.edit');
Route::post('/catalogos/inf_contrato',[InfContratoController::class, 'store'])
    ->name('inf_contrato.store');
Route::put('/catalogos/inf_contrato/{inf_contrato}',[InfContratoController::class, 'update'])
    ->name('inf_contrato.update');
Route::delete('/catalogos/inf_contrato/{inf_contrato}',[InfContratoController::class, 'destroy'])
    ->name('inf_contrato.destroy');

Route::get('/catalogos/inf_credito',[InfCreditoController::class, 'vistaIndex'])
    ->name('inf_credito.index');
Route::get('/catalogos/inf_credito/create',[InfCreditoController::class, 'vistaCreate'])
    ->name('inf_credito.create');
Route::get('/catalogos/inf_credito/{inf_credito}/edit',[InfCreditoController::class, 'vistaEdit'])
    ->name('inf_credito.edit');
Route::post('/catalogos/inf_credito',[InfCreditoController::class, 'store'])
    ->name('inf_credito.store');
Route::put('/catalogos/inf_credito/{inf_credito}',[InfCreditoController::class, 'update'])
    ->name('inf_credito.update');
Route::delete('/catalogos/inf_credito/{inf_credito}',[InfCreditoController::class, 'destroy'])
    ->name('inf_credito.destroy');


Route::get('/catalogos/producto_servicio',[ProductoServicioController::class, 'vistaIndex'])
    ->name('producto_servicio.index');
Route::get('/catalogos/producto_servicio/create',[ProductoServicioController::class, 'vistaCreate'])
    ->name('producto_servicio.create');
Route::get('/catalogos/producto_servicio/{producto_servicio}/edit',[ProductoServicioController::class, 'vistaEdit'])
    ->name('producto_servicio.edit');
Route::post('/catalogos/producto_servicio',[ProductoServicioController::class, 'store'])
    ->name('producto_servicio.store');
Route::put('/catalogos/producto_servicio/{producto_servicio}',[ProductoServicioController::class, 'update'])
    ->name('producto_servicio.update');
Route::delete('/catalogos/producto_servicio/{producto_servicio}',[ProductoServicioController::class, 'destroy'])
    ->name('producto_servicio.destroy');
