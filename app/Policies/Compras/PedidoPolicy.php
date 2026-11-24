<?php

namespace App\Policies\Compras;

use App\Models\Compras\Pedido;
use App\Models\User;
use App\Models\Usuarios\Usuario;
use Illuminate\Auth\Access\Response;

class PedidoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->esSupervisor()
        || $usuario->esGerente()
        || $usuario->esCompras()
        || $usuario->esAlmacen()
        || $usuario->esConsultaGlobal();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Pedido $pedido): bool
    {
        if ($usuario->esSubDirector()) {
            return true;
        }

        if ($usuario->esSupervisor()) {
            return (int) $pedido->created_by
                === (int) $usuario->id;
        }

        if ($usuario->esGerente()) {
            return (int) $pedido->gerencia_id
                === (int) $usuario->gerencia_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->esSupervisor();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Pedido $pedido): bool
    {
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
            $pedido->estadoPedido?->codigo,
            [
                'BORRADOR',
                'RECHAZADO',
            ],
            true
        );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Pedido $pedido): bool
    {
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
            $pedido->estadoPedido?->nombre,
            [
                'BORRADOR',
                'RECHAZADO',
            ],
            true
        );

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Pedido $pedido): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Pedido $pedido): bool
    {
        return false;
    }

    public function enviarAGerencia(Usuario $usuario, Pedido $pedido): bool 
    {
        return
            $usuario->esSupervisor()
            &&
            (int) $pedido->created_by
                === (int) $usuario->id
            &&
            in_array(
                $pedido->estadoPedido?->nombre,
                [
                    'BORRADOR',
                    'RECHAZADO',
                ],
                true
            );
    }

    public function autorizar(Usuario $usuario, Pedido $pedido): bool 
    {
        return
            $usuario->esGerente()
            &&
            (int) $usuario->gerencia_id
                === (int) $pedido->gerencia_id
            &&
            $pedido->estadoPedido?->codigo
                === 'PENDIENTE_GERENCIA';
    }

    public function rechazar(Usuario $usuario, Pedido $pedido): bool 
    {
        return
            $usuario->esGerente()
            &&
            (int) $usuario->gerencia_id
                === (int) $pedido->gerencia_id
            &&
            $pedido->estadoPedido?->nombre
                === 'PENDIENTE_GERENCIA';
    }

    public function enviarACompras(
        Usuario $usuario,
        Pedido $pedido
    ): bool {
        return
            $usuario->esSupervisor()
            &&
            (int) $pedido->created_by
                === (int) $usuario->id
            &&
            $pedido->estadoPedido?->codigo
                === 'AUTORIZADO';
    }
}
