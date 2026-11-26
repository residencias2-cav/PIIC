<?php

namespace Database\Seeders;

use App\Enums\EstadoSolicitudPedido;
use App\Models\Catalogos\Empresa;
use App\Models\Catalogos\Estado;
use App\Models\Catalogos\Gerencia;
use App\Models\Catalogos\Proyecto;
use App\Models\Catalogos\TipoCompra;
use App\Models\Catalogos\TipoPedido;
use App\Models\Catalogos\TipoServicio;
use App\Models\Catalogos\Ubicacion;
use App\Models\Catalogos\Unidad;
use App\Models\Compras\Pedido;
use App\Models\Usuarios\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Catálogos generales
        |--------------------------------------------------------------------------
        */

        $empresa = Empresa::where(
            'rfc',
            'EPP261125T01'
        )->firstOrFail();

        $proyecto = Proyecto::where(
            'nombre',
            'Proyecto PIIC de Prueba'
        )->firstOrFail();

        $ubicacion = Ubicacion::where(
            'nombre',
            'Oficinas centrales'
        )->firstOrFail();

        $estadoInicial = Estado::where(
            'nombre_estado',
            'En espera'
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Tipos de pedido
        |--------------------------------------------------------------------------
        */

        $tipoGeneral = TipoPedido::where(
            'nombre',
            'Pedido general'
        )->firstOrFail();

        $tipoInterno = TipoPedido::where(
            'nombre',
            'Pedido interno'
        )->firstOrFail();

        $tipoAlmacen = TipoPedido::where(
            'nombre',
            'Pedido almacen'
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Tipos de compra
        |--------------------------------------------------------------------------
        */

        $compraGeneral = TipoCompra::where(
            'nombre',
            'General'
        )->firstOrFail();

        $compraPapeleria = TipoCompra::where(
            'nombre',
            'Papeleria'
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Gerencias
        |--------------------------------------------------------------------------
        */

        $gerenciaGti = Gerencia::where(
            'code',
            'GTI'
        )->firstOrFail();

        $gerenciaGchso = Gerencia::where(
            'code',
            'GCHSO'
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Supervisores
        |--------------------------------------------------------------------------
        */

        $supervisorGti = Usuario::where(
            'usuario',
            'sup_gti'
        )->firstOrFail();

        $supervisorGchso = Usuario::where(
            'usuario',
            'sup_gchso'
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Crear pedidos
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $empresa,
            $proyecto,
            $ubicacion,
            $estadoInicial,
            $tipoGeneral,
            $tipoInterno,
            $tipoAlmacen,
            $compraGeneral,
            $compraPapeleria,
            $gerenciaGti,
            $gerenciaGchso,
            $supervisorGti,
            $supervisorGchso
        ): void {

            /*
            |--------------------------------------------------------------------------
            | GTI - Borrador
            |--------------------------------------------------------------------------
            */

            $this->crearPedido(
                folio: 'TEST-GTI-001',
                tipoPedidoId: $tipoGeneral->id,
                gerenciaId: $gerenciaGti->id,
                empresaId: $empresa->id,
                proyectoId: $proyecto->id,
                ubicacionId: $ubicacion->id,
                tipoCompraId: $compraGeneral->id,
                estadoId: $estadoInicial->id,
                estadoSolicitud: EstadoSolicitudPedido::BORRADOR,
                createdBy: $supervisorGti->id,
                observaciones: 'Pedido GTI en borrador para probar edición.',
                montoCredito: 0,
                monto: 1000
            );

            /*
            |--------------------------------------------------------------------------
            | GTI - Pendiente de gerencia
            |--------------------------------------------------------------------------
            */

            $this->crearPedido(
                folio: 'TEST-GTI-002',
                tipoPedidoId: $tipoGeneral->id,
                gerenciaId: $gerenciaGti->id,
                empresaId: $empresa->id,
                proyectoId: $proyecto->id,
                ubicacionId: $ubicacion->id,
                tipoCompraId: $compraGeneral->id,
                estadoId: $estadoInicial->id,
                estadoSolicitud: EstadoSolicitudPedido::PENDIENTE_GERENCIA,
                createdBy: $supervisorGti->id,
                observaciones: 'Pedido GTI pendiente de revisión gerencial.',
                montoCredito: 0,
                monto: 2500
            );

            /*
            |--------------------------------------------------------------------------
            | GTI - Rechazado
            |--------------------------------------------------------------------------
            */

            $this->crearPedido(
                folio: 'TEST-GTI-003',
                tipoPedidoId: $tipoGeneral->id,
                gerenciaId: $gerenciaGti->id,
                empresaId: $empresa->id,
                proyectoId: $proyecto->id,
                ubicacionId: $ubicacion->id,
                tipoCompraId: $compraGeneral->id,
                estadoId: $estadoInicial->id,
                estadoSolicitud: EstadoSolicitudPedido::RECHAZADO,
                createdBy: $supervisorGti->id,
                observaciones: 'Pedido GTI rechazado para probar correcciones.',
                montoCredito: 0,
                monto: 1750
            );

            /*
            |--------------------------------------------------------------------------
            | GTI - Autorizado
            |--------------------------------------------------------------------------
            */

            $this->crearPedido(
                folio: 'TEST-GTI-004',
                tipoPedidoId: $tipoGeneral->id,
                gerenciaId: $gerenciaGti->id,
                empresaId: $empresa->id,
                proyectoId: $proyecto->id,
                ubicacionId: $ubicacion->id,
                tipoCompraId: $compraGeneral->id,
                estadoId: $estadoInicial->id,
                estadoSolicitud: EstadoSolicitudPedido::AUTORIZADO,
                createdBy: $supervisorGti->id,
                observaciones: 'Pedido GTI autorizado por Gerencia.',
                montoCredito: 0,
                monto: 4000
            );

            /*
            |--------------------------------------------------------------------------
            | GTI - Enviado a Compras
            |--------------------------------------------------------------------------
            */

            $this->crearPedido(
                folio: 'TEST-GTI-005',
                tipoPedidoId: $tipoGeneral->id,
                gerenciaId: $gerenciaGti->id,
                empresaId: $empresa->id,
                proyectoId: $proyecto->id,
                ubicacionId: $ubicacion->id,
                tipoCompraId: $compraGeneral->id,
                estadoId: $estadoInicial->id,
                estadoSolicitud: EstadoSolicitudPedido::ENVIADO_COMPRAS,
                createdBy: $supervisorGti->id,
                observaciones: 'Pedido GTI enviado al departamento de Compras.',
                montoCredito: 0,
                monto: 5250
            );

            /*
            |--------------------------------------------------------------------------
            | GCHSO - Borrador
            |--------------------------------------------------------------------------
            */

            $this->crearPedido(
                folio: 'TEST-GCHSO-001',
                tipoPedidoId: $tipoGeneral->id,
                gerenciaId: $gerenciaGchso->id,
                empresaId: $empresa->id,
                proyectoId: $proyecto->id,
                ubicacionId: $ubicacion->id,
                tipoCompraId: $compraGeneral->id,
                estadoId: $estadoInicial->id,
                estadoSolicitud: EstadoSolicitudPedido::BORRADOR,
                createdBy: $supervisorGchso->id,
                observaciones: 'Pedido GCHSO en borrador para prueba cruzada.',
                montoCredito: 0,
                monto: 1200
            );

            /*
            |--------------------------------------------------------------------------
            | GCHSO - Pendiente de gerencia
            |--------------------------------------------------------------------------
            */

            $this->crearPedido(
                folio: 'TEST-GCHSO-002',
                tipoPedidoId: $tipoGeneral->id,
                gerenciaId: $gerenciaGchso->id,
                empresaId: $empresa->id,
                proyectoId: $proyecto->id,
                ubicacionId: $ubicacion->id,
                tipoCompraId: $compraGeneral->id,
                estadoId: $estadoInicial->id,
                estadoSolicitud: EstadoSolicitudPedido::PENDIENTE_GERENCIA,
                createdBy: $supervisorGchso->id,
                observaciones: 'Pedido GCHSO pendiente de Gerencia.',
                montoCredito: 0,
                monto: 3600
            );

            /*
            |--------------------------------------------------------------------------
            | GCHSO - Enviado a Compras
            |--------------------------------------------------------------------------
            */

            $this->crearPedido(
                folio: 'TEST-GCHSO-003',
                tipoPedidoId: $tipoGeneral->id,
                gerenciaId: $gerenciaGchso->id,
                empresaId: $empresa->id,
                proyectoId: $proyecto->id,
                ubicacionId: $ubicacion->id,
                tipoCompraId: $compraGeneral->id,
                estadoId: $estadoInicial->id,
                estadoSolicitud: EstadoSolicitudPedido::ENVIADO_COMPRAS,
                createdBy: $supervisorGchso->id,
                observaciones: 'Pedido GCHSO enviado a Compras.',
                montoCredito: 0,
                monto: 4700
            );

            /*
            |--------------------------------------------------------------------------
            | Pedido interno GTI
            |--------------------------------------------------------------------------
            */

            $pedidoInterno = $this->crearPedido(
                folio: 'TEST-GTI-INT-01',
                tipoPedidoId: $tipoInterno->id,
                gerenciaId: $gerenciaGti->id,
                empresaId: $empresa->id,
                proyectoId: $proyecto->id,
                ubicacionId: $ubicacion->id,
                tipoCompraId: $compraGeneral->id,
                estadoId: $estadoInicial->id,
                estadoSolicitud: EstadoSolicitudPedido::BORRADOR,
                createdBy: $supervisorGti->id,
                observaciones: 'Servicio interno de mantenimiento de prueba.',
                montoCredito: 0,
                monto: 800
            );

            $tipoServicio = TipoServicio::where(
                'nombre',
                'Mantenimientos'
            )->firstOrFail();

            DB::table('pedido_internos')->updateOrInsert(
                [
                    'pedido_id' => $pedidoInterno->id,
                    'tipo_servicio_id' => $tipoServicio->id,
                ],
                [
                    'descripcion' => 'Mantenimiento preventivo de equipo.',
                    'fecha_devolucion' => now()
                        ->addDays(7)
                        ->toDateString(),
                    'fecha_entrega' => now()
                        ->toDateString(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Pedido de almacén GTI
            |--------------------------------------------------------------------------
            */

            $pedidoAlmacen = $this->crearPedido(
                folio: 'TEST-GTI-ALM-01',
                tipoPedidoId: $tipoAlmacen->id,
                gerenciaId: $gerenciaGti->id,
                empresaId: $empresa->id,
                proyectoId: $proyecto->id,
                ubicacionId: $ubicacion->id,
                tipoCompraId: $compraPapeleria->id,
                estadoId: $estadoInicial->id,
                estadoSolicitud: EstadoSolicitudPedido::BORRADOR,
                createdBy: $supervisorGti->id,
                observaciones: 'Pedido de almacén con partidas de prueba.',
                montoCredito: 500,
                monto: 1500
            );

            $unidadPieza = Unidad::where(
                'nombre',
                'Pieza'
            )->firstOrFail();

            $unidadCaja = Unidad::where(
                'nombre',
                'Caja'
            )->firstOrFail();

            $this->crearDetalle(
                pedidoId: $pedidoAlmacen->id,
                partida: 1,
                cantidad: 10,
                unidadId: $unidadPieza->id,
                descripcion: 'Carpeta tamaño carta',
                uso: 'Uso administrativo',
                credito: false,
                fechaPago: now()->toDateString(),
                codigo: 'TEST-CARP-001'
            );

            $this->crearDetalle(
                pedidoId: $pedidoAlmacen->id,
                partida: 2,
                cantidad: 2,
                unidadId: $unidadCaja->id,
                descripcion: 'Papel tamaño carta',
                uso: 'Impresiones administrativas',
                credito: true,
                fechaPago: now()
                    ->addDays(30)
                    ->toDateString(),
                codigo: 'TEST-PAPEL-001'
            );
        });

        if ($this->command) {
            $this->command->info(
                'Pedidos de prueba creados correctamente.'
            );
        }
    }

    /**
     * Crear o actualizar un pedido.
     */
    private function crearPedido(
        string $folio,
        int $tipoPedidoId,
        int $gerenciaId,
        int $empresaId,
        int $proyectoId,
        int $ubicacionId,
        int $tipoCompraId,
        int $estadoId,
        EstadoSolicitudPedido $estadoSolicitud,
        int $createdBy,
        string $observaciones,
        int $montoCredito,
        int $monto
    ): Pedido {
        return Pedido::updateOrCreate(
            [
                'folio' => $folio,
            ],
            [
                'fecha' => now()->toDateString(),
                'tipo_pedido_id' => $tipoPedidoId,
                'gerencia_id' => $gerenciaId,
                'empresa_id' => $empresaId,
                'proyecto_id' => $proyectoId,
                'ubicacion_id' => $ubicacionId,
                'tipo_compra_id' => $tipoCompraId,
                'estado_id' => $estadoId,
                'estado_solicitud' => $estadoSolicitud,
                'observaciones' => $observaciones,
                'monto_credito' => $montoCredito,
                'monto' => $monto,
                'created_by' => $createdBy,
            ]
        );
    }

    /**
     * Crear o actualizar una partida de almacén.
     */
    private function crearDetalle(
        int $pedidoId,
        int $partida,
        int $cantidad,
        int $unidadId,
        string $descripcion,
        string $uso,
        bool $credito,
        string $fechaPago,
        string $codigo
    ): void {
        DB::table('detalle_pedidos')->updateOrInsert(
            [
                'pedido_id' => $pedidoId,
                'partida' => $partida,
            ],
            [
                'cantidad' => $cantidad,
                'unidad_id' => $unidadId,
                'descripcion' => $descripcion,
                'uso' => $uso,
                'credito' => $credito,
                'fecha_pago' => $fechaPago,
                'codigo' => $codigo,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}