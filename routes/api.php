<?php

use Illuminate\Http\Request;
use App\Http\Controllers\{
    LugarController,
    ObraController,
    GerenciaController,
    EmpresaController,
    EstadoController,
    TipoCompraController,
    TipoPedidoController,
    UbicacionController,
    UnidadController,
    ProyectoController,
    TipoServicioController,
    ProductoServicioController,
    EstadoPedidoController,
    TipoCotizacionController,
    LugarNacimientoController,
    ArticuloController,
    ContratoController,
    TipoSangreController,
    TipoUsuarioController,
    TipoOficioController,
    InfCreditoController,
    TipoEppController,
    InfContratoController
    };

use Illuminate\Support\Facades\Route;

Route::prefix('catalogos')->group(function () {
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
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
