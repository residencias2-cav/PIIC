<?php

namespace App\Policies\Epp;

use App\Models\Epp\InventarioEpp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InventarioEppPolicy
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
    public function view(User $user, InventarioEpp $inventarioEpp): bool
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
    public function update(User $user, InventarioEpp $inventarioEpp): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InventarioEpp $inventarioEpp): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InventarioEpp $inventarioEpp): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InventarioEpp $inventarioEpp): bool
    {
        return false;
    }
}
