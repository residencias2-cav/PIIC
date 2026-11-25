<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Catalogos\{
    LugarController,
    ObraController,
    GerenciaController,
    EmpresaController,
    UbicacionController,
    ProyectoController,
    ProductoServicioController,
    ArticuloController,
    InfCreditoController,
    InfContratoController
    };
use App\Http\Controllers\Api\Epp\{
    EppController,
    InventarioEppController,
    };
use App\Http\Controllers\Api\Usuarios\{
    TrabajadorController,
    };
use App\Http\Controllers\Api\Proveedores\{
    ProveedorController,
    ProveedorServicioController,
    DatosProveedorController,
    InformacionBancariaController,
    };
use App\Http\Controllers\Api\Compras\{
    PedidoController,
    CotizacionController,
    AutorizadoPorController,
    FolioComprasController,
    PagoController,
    };
use App\Http\Controllers\Api\Oficios\{
    OficiosController,
    };
    /*
    |--------------
    | PAGINA PRINCIPAL
    |--------------
    */
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('panel')
        : redirect()->route('login');
});

    /*
    |--------------
    | AUTENTICACION
    |--------------
    */
/*Route::view('/login', 'auth.login')
    ->name('login');
Route::middleware('guest')->group(function () {
    Route::get(
        '/login',
        [LoginController::class, 'create']
    )->name('login');
    Route::post(
        '/login',
        [LoginController::class, 'store']
    )->name('login.store');
});
Route::post(
    '/logout',
    [LoginController::class, 'destroy']
)
->middleware('auth')
->name('logout');*/

    /*
    |--------------
    | PANEL
    |--------------
    */
/*Route::view('/panel', 'auth.panel')
    ->name('panel');*/

Route::middleware('auth')->group(function () {

        Route::get('/panel', function () {
            return view('auth.panel');
        })->name('panel');

        Route::get('/seguridad', function () {
            return view('auth.seguridad');
        })->name('seguridad');

        /*
        |--------------
        | CATÁLOGOS
        |--------------
        */
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

        /*
        |--------------
        | COMPRAS
        |--------------
        */
    Route::get('/pedidos',[PedidoController::class, 'vistaIndex'])
        ->name('pedido.index');
    Route::get('/pedidos/create',[PedidoController::class, 'vistaCreate'])
        ->name('pedido.create');
    Route::get('/pedidos/{pedido}/edit',[PedidoController::class, 'vistaEdit'])
        ->name('pedido.edit');
    Route::post('/pedidos',[PedidoController::class, 'store'])
        ->name('pedido.store');
    Route::put('/pedidos/{pedido}',[PedidoController::class, 'update'])
        ->name('pedido.update');
    Route::delete('/pedidos/{pedido}',[PedidoController::class, 'destroy'])
        ->name('pedido.destroy');

    Route::get('/cotizaciones', [CotizacionController::class, 'index'])
    ->name('cotizaciones.index');
    Route::get('/cotizaciones/create', [CotizacionController::class, 'create'])
    ->name('cotizaciones.create');
    Route::post('/cotizaciones', [CotizacionController::class, 'store'])
    ->name('cotizaciones.store');
    Route::get('/cotizaciones/{cotizacion}', [CotizacionController::class, 'show'])
    ->name('cotizaciones.show');
    Route::get('/cotizaciones/{cotizacion}/edit', [CotizacionController::class, 'edit'])
        ->name('cotizaciones.edit');
        Route::put('/cotizaciones/{cotizacion}', [CotizacionController::class, 'update'])
        ->name('cotizaciones.update');
    Route::delete('/cotizaciones/{cotizacion}', [CotizacionController::class, 'destroy'])
    ->name('cotizaciones.destroy');

    Route::get('/autorizado_por', [AutorizadoPorController::class, 'index'])
    ->name('autorizado_por.index');
    Route::get('/autorizado_por/create', [AutorizadoPorController::class, 'create'])
        ->name('autorizado_por.create');
    Route::post('/autorizado_por', [AutorizadoPorController::class, 'store'])
        ->name('autorizado_por.store');
    Route::get('/autorizado_por/{autorizado_por}', [AutorizadoPorController::class, 'show'])
    ->name('autorizado_por.show');
    Route::get('/autorizado_por/{autorizado_por}/edit', [AutorizadoPorController::class, 'edit'])
        ->name('autorizado_por.edit');
    Route::put('/autorizado_por/{autorizado_por}', [AutorizadoPorController::class, 'update'])
    ->name('autorizado_por.update');
    Route::delete('/autorizado_por/{autorizado_por}', [AutorizadoPorController::class, 'destroy'])
        ->name('autorizado_por.destroy');

    Route::get('/folio_compras', [FolioComprasController::class, 'index'])
    ->name('folio_compras.index');
    Route::get('/folio_compras/create', [FolioComprasController::class, 'create'])
        ->name('folio_compras.create');
        Route::post('/folio_compras', [FolioComprasController::class, 'store'])
        ->name('folio_compras.store');
    Route::get('/folio_compras/{folio_compras}', [FolioComprasController::class, 'show'])
    ->name('folio_compras.show');
    Route::get('/folio_compras/{folio_compras}/edit', [FolioComprasController::class, 'edit'])
        ->name('folio_compras.edit');
    Route::put('/folio_compras/{folio_compras}', [FolioComprasController::class, 'update'])
        ->name('folio_compras.update');
        Route::delete('/folio_compras/{folio_compras}', [FolioComprasController::class, 'destroy'])
        ->name('folio_compras.destroy');

    Route::get('/pago', [PagoController::class, 'index'])
            ->name('pago.index');
            Route::get('/pago/create', [PagoController::class, 'create'])
        ->name('pago.create');
    Route::post('/pago', [PagoController::class, 'store'])
        ->name('pago.store');
    Route::get('/pago/{pago}', [PagoController::class, 'show'])
    ->name('pago.show');
    Route::get('/pago/{pago}/edit', [PagoController::class, 'edit'])
        ->name('pago.edit');
        Route::put('/pago/{pago}', [PagoController::class, 'update'])
        ->name('pago.update');
        Route::delete('/pago/{pago}', [PagoController::class, 'destroy'])
        ->name('pago.destroy');
        /*
        |--------------
        | EPP
        |--------------
        */
    Route::get('/epp',[EppController::class, 'vistaIndex'])
        ->name('epp.index');
    Route::get('/epp/create',[EppController::class, 'vistaCreate'])
        ->name('epp.create');
    Route::get('/epp/{epp}/edit',[EppController::class, 'vistaEdit'])
        ->name('epp.edit');
    Route::post('/epp',[EppController::class, 'store'])
        ->name('epp.store');
    Route::put('/epp/{epp}',[EppController::class, 'update'])
        ->name('epp.update');
    Route::delete('/epp/{epp}',[EppController::class, 'destroy'])
        ->name('epp.destroy');

    Route::get('/epp/inventario',[InventarioEppController::class, 'vistaIndex'])
        ->name('inventario_epp.index');
    Route::get('/epp/inventario/create',[InventarioEppController::class, 'vistaCreate'])
        ->name('inventario_epp.create');
    Route::get('/epp/inventario/{inventario}/edit',[InventarioEppController::class, 'vistaEdit'])
        ->name('inventario_epp.edit');
    Route::post('/epp/inventario',[InventarioEppController::class, 'store'])
        ->name('inventario_epp.store');
    Route::put('/epp/inventario/{inventario}',[InventarioEppController::class, 'update'])
        ->name('inventario_epp.update');
    Route::delete('/epp/inventario/{inventario}',[InventarioEppController::class, 'destroy'])
        ->name('inventario_epp.destroy');
        /*
        |--------------
        | OFICIOS
        |--------------
        */
    Route::get('/oficios',[OficiosController::class, 'vistaIndex'])
        ->name('oficios.index');
    Route::get('/oficios/create',[OficiosController::class, 'vistaCreate'])
        ->name('oficios.create');
    Route::get('/oficios/{oficios}/edit',[OficiosController::class, 'vistaEdit'])
        ->name('oficios.edit');
    Route::post('/oficios',[OficiosController::class, 'store'])
        ->name('oficios.store');
    Route::put('/oficios/{oficios}',[OficiosController::class, 'update'])
        ->name('oficios.update');
    Route::delete('/oficios/{oficios}',[OficiosController::class, 'destroy'])
    ->name('oficios.destroy');
        /*
        |--------------
        | PROVEEDORES
        |--------------
        */
    Route::get('/proveedores',[ProveedorController::class, 'vistaIndex'])
        ->name('proveedor.index');
    Route::get('/proveedores/create',[ProveedorController::class, 'vistaCreate'])
        ->name('proveedor.create');
    Route::get('/proveedores/{proveedor}/edit',[ProveedorController::class, 'vistaEdit'])
        ->name('proveedor.edit');
        Route::post('/proveedores',[ProveedorController::class, 'store'])
        ->name('proveedor.store');
    Route::put('/proveedores/{proveedor}',[ProveedorController::class, 'update'])
        ->name('proveedor.update');
    Route::delete('/proveedores/{proveedor}',[ProveedorController::class, 'destroy'])
        ->name('proveedor.destroy');
        
    Route::get('/proveedor_servicio',[ProveedorServicioController::class, 'vistaIndex'])
        ->name('proveedor_servicio.index');
    Route::get('/proveedor_servicio/create',[ProveedorServicioController::class, 'vistaCreate'])
        ->name('proveedor_servicio.create');
        Route::get('/proveedor_servicio/{proveedor_servicio}/edit',[ProveedorServicioController::class, 'vistaEdit'])
        ->name('proveedor_servicio.edit');
    Route::post('/proveedor_servicio',[ProveedorServicioController::class, 'store'])
        ->name('proveedor_servicio.store');
        Route::put('/proveedor_servicio/{proveedor_servicio}',[ProveedorServicioController::class, 'update'])
        ->name('proveedor_servicio.update');
    Route::delete('/proveedor_servicio/{proveedor_servicio}',[ProveedorServicioController::class, 'destroy'])
        ->name('proveedor_servicio.destroy');

    Route::get('/datos_proveedor',[DatosProveedorController::class, 'vistaIndex'])
    ->name('datos_proveedor.index');
    Route::get('/datos_proveedor/create',[DatosProveedorController::class, 'vistaCreate'])
        ->name('datos_proveedor.create');
    Route::get('/datos_proveedor/{datos_proveedor}/edit',[DatosProveedorController::class, 'vistaEdit'])
        ->name('datos_proveedor.edit');
        Route::post('/datos_proveedor',[DatosProveedorController::class, 'store'])
        ->name('datos_proveedor.store');
    Route::put('/datos_proveedor/{datos_proveedor}',[DatosProveedorController::class, 'update'])
        ->name('datos_proveedor.update');
        Route::delete('/datos_proveedor/{datos_proveedor}',[DatosProveedorController::class, 'destroy'])
        ->name('datos_proveedor.destroy');
        
        Route::get('/informacion_bancaria',[InformacionBancariaController::class, 'vistaIndex'])
        ->name('informacion_bancaria.index');
    Route::get('/informacion_bancaria/create',[InformacionBancariaController::class, 'vistaCreate'])
        ->name('informacion_bancaria.create');
        Route::get('/informacion_bancaria/{informacion_bancaria}/edit',[InformacionBancariaController::class, 'vistaEdit'])
        ->name('informacion_bancaria.edit');
    Route::post('/informacion_bancaria',[InformacionBancariaController::class, 'store'])
    ->name('informacion_bancaria.store');
    Route::put('/informacion_bancaria/{informacion_bancaria}',[InformacionBancariaController::class, 'update'])
        ->name('informacion_bancaria.update');
    Route::delete('/informacion_bancaria/{informacion_bancaria}',[InformacionBancariaController::class, 'destroy'])
    ->name('informacion_bancaria.destroy');
    /*
        |--------------
        | USUARIOS
        |--------------
        */
    Route::get('/trabajadores',[TrabajadorController::class, 'vistaIndex'])
        ->name('trabajador.index');
    Route::get('/trabajadores/create',[TrabajadorController::class, 'vistaCreate'])
        ->name('trabajador.create');
    Route::get('/trabajadores/{trabajador}/edit',[TrabajadorController::class, 'vistaEdit'])
    ->name('trabajador.edit');
    Route::post('/trabajadores',[TrabajadorController::class, 'store'])
    ->name('trabajador.store');
    Route::put('/trabajadores/{trabajador}',[TrabajadorController::class, 'update'])
        ->name('trabajador.update');
    Route::delete('/trabajadores/{trabajador}',[TrabajadorController::class, 'destroy'])
    ->name('trabajador.destroy');
});