<?php

namespace App\Policies\Compras;

use App\Models\Compras\DatosCotizacion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DatosCotizacionPolicy
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
    public function view(User $user, DatosCotizacion $datosCotizacion): bool
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
    public function update(User $user, DatosCotizacion $datosCotizacion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DatosCotizacion $datosCotizacion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DatosCotizacion $datosCotizacion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DatosCotizacion $datosCotizacion): bool
    {
        return false;
    }
}
