<?php

namespace App\Policies\Compras;

use App\Enums\EstadoSolicitudPedido;
use App\Models\Compras\Pedido;
use App\Models\Usuarios\Usuario;

class PedidoPolicy
{
    /**
     * Determina quién puede ingresar al listado de pedidos.
     *
     * El filtrado de los registros visibles se realiza
     * posteriormente desde la consulta del controlador.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->esSupervisor()
            || $usuario->esGerente()
            || $usuario->esCompras()
            || $usuario->esAlmacen()
            || $usuario->esSubDirector();
    }

    /**
     * Determina quién puede consultar un pedido concreto.
     */
    public function view(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        /*
         * SUBDIR tiene acceso global de sólo lectura.
         */
        if ($usuario->esSubDirector()) {
            return true;
        }

        /*
         * El supervisor solamente puede consultar
         * los pedidos que haya creado.
         */
        if ($usuario->esSupervisor()) {
            return (int) $pedido->created_by
                === (int) $usuario->id;
        }

        /*
         * El gerente puede consultar los pedidos
         * de todos los supervisores de su gerencia.
         */
        if ($usuario->esGerente()) {
            return (int) $pedido->gerencia_id
                === (int) $usuario->gerencia_id;
        }

        /*
         * Compras solamente debe consultar pedidos
         * que ya hayan sido enviados a su departamento.
         */
        if ($usuario->esCompras()) {
            return $pedido->estado_solicitud
                === EstadoSolicitudPedido::ENVIADO_COMPRAS;
        }

        /*
         * Almacén consulta solicitudes de tipo Almacén.
         *
         * Esta condición presupone que Pedido tiene
         * la relación tipoPedido().
         */
        if ($usuario->esAlmacen()) {
            return $pedido->tipoPedido?->nombre
                === 'Almacén';
        }

        return false;
    }

    /**
     * Los supervisores son quienes capturan pedidos.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->esSupervisor();
    }

    /**
     * El supervisor puede modificar únicamente:
     *
     * 1. Los pedidos creados por él mismo.
     * 2. Pedidos en borrador.
     * 3. Pedidos rechazados por Gerencia.
     */
    public function update(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        if (! $usuario->esSupervisor()) {
            return false;
        }

        if (
            (int) $pedido->created_by
            !== (int) $usuario->id
        ) {
            return false;
        }

        return in_array(
            $pedido->estado_solicitud,
            [
                EstadoSolicitudPedido::BORRADOR,
                EstadoSolicitudPedido::RECHAZADO,
            ],
            true
        );
    }

    /**
     * El supervisor puede eliminar únicamente
     * sus propios pedidos que todavía se encuentren
     * en borrador o que hayan sido rechazados.
     *
     * Si Pedido usa SoftDeletes, esta operación
     * solamente enviará el registro a la papelera.
     */
    public function delete(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        if (! $usuario->esSupervisor()) {
            return false;
        }

        if (
            (int) $pedido->created_by
            !== (int) $usuario->id
        ) {
            return false;
        }

        return in_array(
            $pedido->estado_solicitud,
            [
                EstadoSolicitudPedido::BORRADOR,
                EstadoSolicitudPedido::RECHAZADO,
            ],
            true
        );
    }

    /**
     * Restaurar pedidos eliminados queda reservado
     * al administrador.
     *
     * Gate::before() autoriza al ADMIN antes de
     * evaluar este false.
     */
    public function restore(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        return false;
    }

    /**
     * La eliminación definitiva queda reservada
     * al administrador.
     *
     * Gate::before() autoriza al ADMIN antes de
     * evaluar este false.
     */
    public function forceDelete(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        return false;
    }

    /**
     * El supervisor creador puede enviar el pedido
     * a revisión gerencial.
     *
     * También permite reenviar un pedido rechazado
     * una vez que haya sido corregido.
     */
    public function enviarAGerencia(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        return $usuario->esSupervisor()
            && (int) $pedido->created_by
                === (int) $usuario->id
            && in_array(
                $pedido->estado_solicitud,
                [
                    EstadoSolicitudPedido::BORRADOR,
                    EstadoSolicitudPedido::RECHAZADO,
                ],
                true
            );
    }

    /**
     * Un gerente puede autorizar únicamente pedidos:
     *
     * 1. De su propia gerencia.
     * 2. Pendientes de revisión gerencial.
     */
    public function autorizar(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        return $usuario->esGerente()
            && (int) $usuario->gerencia_id
                === (int) $pedido->gerencia_id
            && $pedido->estado_solicitud
                === EstadoSolicitudPedido::PENDIENTE_GERENCIA;
    }

    /**
     * El gerente puede rechazar un pedido bajo
     * las mismas condiciones necesarias para autorizarlo.
     *
     * La diferencia se encuentra en los datos que
     * el controlador registra como resultado.
     */
    public function rechazar(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        return $usuario->esGerente()
            && (int) $usuario->gerencia_id
                === (int) $pedido->gerencia_id
            && $pedido->estado_solicitud
                === EstadoSolicitudPedido::PENDIENTE_GERENCIA;
    }

    /**
     * Después de la autorización gerencial, el supervisor
     * creador puede canalizar el pedido a Compras.
     */
    public function enviarACompras(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        return $usuario->esSupervisor()
            && (int) $pedido->created_by
                === (int) $usuario->id
            && $pedido->estado_solicitud
                === EstadoSolicitudPedido::AUTORIZADO;
    }

    /**
     * Compras puede comenzar el procesamiento de un pedido
     * que haya sido canalizado correctamente a su área.
     */
    public function procesar(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        return $usuario->esCompras()
            && $pedido->estado_solicitud
                === EstadoSolicitudPedido::ENVIADO_COMPRAS;
    }

    /**
     * Compras puede modificar el estado operativo
     * de un pedido que ya se encuentra bajo su atención.
     *
     * Esta autorización no cambia estado_solicitud.
     * Permite actualizar estado_id con valores operativos
     * como Cotizando, Recibido, Surtido Parcial o Surtido.
     */
    public function actualizarEstadoOperativo(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        return $usuario->esCompras()
            && $pedido->estado_solicitud
                === EstadoSolicitudPedido::ENVIADO_COMPRAS;
    }

    /**
     * Almacén puede actualizar información operativa
     * únicamente en solicitudes pertenecientes al flujo
     * de pedidos de almacén.
     */
    public function actualizarAlmacen(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        return $usuario->esAlmacen()
            && $pedido->tipoPedido?->nombre
                === 'Almacén'
            && $pedido->estado_solicitud
                === EstadoSolicitudPedido::ENVIADO_COMPRAS;
    }
}