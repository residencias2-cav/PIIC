<?php

namespace App\Policies\Oficios;

use App\Models\OficiosProductos;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OficiosProductosPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OficiosProductos $oficiosProductos): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OficiosProductos $oficiosProductos): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OficiosProductos $oficiosProductos): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OficiosProductos $oficiosProductos): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OficiosProductos $oficiosProductos): bool
    {
        return false;
    }
}
