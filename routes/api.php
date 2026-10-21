<?php

use Illuminate\Http\Request;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\GerenciaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\TipoCompraController;
use App\Http\Controllers\TipoPedidoController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\ProductoServicioController;
use App\Http\Controllers\EstadoPedidoController;
use App\Http\Controllers\TipoCotizacionController;
use App\Http\Controllers\LugarNacimientoController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\TipoSangreController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\TipoOficioController;
use App\Http\Controllers\InfCreditoController;
use App\Http\Controllers\TipoEppController;
use App\Http\Controllers\InfContratoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('lugar', LugarController::class);
Route::apiResource('obra', ObraController::class);
Route::apiResource('gerencia', GerenciaController::class);
Route::apiResource('empresa', EmpresaController::class);
Route::apiResource('ubicacion', UbicacionController::class);
Route::apiResource('proyecto', ProyectoController::class);
Route::apiResource('producto_servicio', ProductoServicioController::class);
Route::apiResource('articulo', ArticuloController::class);
Route::apiResource('inf_credito', InfCreditoController::class);
Route::apiResource('inf_contrato', InfContratoController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
