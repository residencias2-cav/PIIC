<?php

namespace App\Http\Controllers;

use App\Enums\EstadoSolicitudPedido;
use App\Models\Compras\Pedido;
use App\Models\Compras\Autorizacion;
use App\Models\Usuarios\Usuario;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function index()
    {
        /** @var Usuario $usuario */
        $usuario = Auth::user();

        // Permisos para mostrar las opciones del panel
        $puedeCrearPedidos = $usuario->esSupervisor();
        $puedeAutorizarPedidos = $usuario->esGerente();
        $puedeProcesarPedidos = $usuario->esCompras();

        // Consulta base de pedidos
        $pedidosQuery = Pedido::query()
            ->with([
                'tipoPedido',
                'gerencia',
                'estado'
            ]);

        // PEDIDOS VISIBLES SEGÚN EL TIPO DE USUARIO
        if ($usuario->esCompras()) {

            // Compras consulta pedidos autorizados y en atención
            $pedidosQuery->whereIn('estado_solicitud', [
                EstadoSolicitudPedido::AUTORIZADO->value,
                EstadoSolicitudPedido::ENVIADO_COMPRAS->value,
                EstadoSolicitudPedido::EN_PROCESO->value,
            ]);

        } elseif ($usuario->esGerente()) {

            // El gerente consulta los pedidos de su gerencia
            $pedidosQuery->where(
                'gerencia_id',
                $usuario->gerencia_id
            );

        } else {

            // Los demás usuarios consultan sus propios pedidos
            $pedidosQuery->where(
                'created_by',
                $usuario->getKey()
            );
        }

        // Obtener pedidos visibles
        $pedidos = (clone $pedidosQuery)
            ->latest('created_at')
            ->get();

        // CONTADORES POR TIPO DE PEDIDO
        $pedidosGeneral = (clone $pedidosQuery)
            ->where('tipo_pedido_id', 1)
            ->count();

        $pedidosInt = (clone $pedidosQuery)
            ->where('tipo_pedido_id', 2)
            ->count();

        $pedidosAlm = (clone $pedidosQuery)
            ->where('tipo_pedido_id', 3)
            ->count();

        $totalPedidos = (clone $pedidosQuery)->count();

        // CONTADORES POR ESTADO
        $pedidosPendientes = (clone $pedidosQuery)
            ->where(
                'estado_solicitud',
                EstadoSolicitudPedido::PENDIENTE_GERENCIA->value
            )
            ->count();

        $pedidosAutorizados = (clone $pedidosQuery)
            ->where(
                'estado_solicitud',
                EstadoSolicitudPedido::AUTORIZADO->value
            )
            ->count();

        $pedidosEnProceso = (clone $pedidosQuery)
            ->where(
                'estado_solicitud',
                EstadoSolicitudPedido::EN_PROCESO->value
            )
            ->count();

        // AUTORIZACIONES PENDIENTES PARA GERENCIA
        $autorizaciones = collect();

        if ($usuario->esGerente()) {

            $autorizaciones = Autorizacion::query()
                ->with([
                    'pedido.tipoPedido',
                    'pedido.gerencia'
                ])
                ->where('proceso_autorizado', false)
                ->whereHas('pedido', function ($query) use ($usuario) {

                    $query->where(
                        'gerencia_id',
                        $usuario->gerencia_id
                    )->where(
                        'estado_solicitud',
                        EstadoSolicitudPedido::PENDIENTE_GERENCIA->value
                    );

                })
                ->latest('created_at')
                ->get();
        }

        // ACTIVIDAD RECIENTE
        $actividadReciente = (clone $pedidosQuery)
            ->latest('created_at')
            ->limit(5)
            ->get();

        return view('auth.panel', compact(
            'usuario',
            'pedidos',
            'pedidosGeneral',
            'pedidosAlm',
            'pedidosInt',
            'totalPedidos',
            'pedidosPendientes',
            'pedidosAutorizados',
            'pedidosEnProceso',
            'autorizaciones',
            'actividadReciente',
            'puedeCrearPedidos',
            'puedeAutorizarPedidos',
            'puedeProcesarPedidos'
        ));
    }
}