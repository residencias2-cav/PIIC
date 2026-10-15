<?php

namespace App\Policies;

use App\Models\InformacionBancaria;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InformacionBancariaPolicy
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
    public function view(User $user, InformacionBancaria $informacionBancaria): bool
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
    public function update(User $user, InformacionBancaria $informacionBancaria): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InformacionBancaria $informacionBancaria): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InformacionBancaria $informacionBancaria): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InformacionBancaria $informacionBancaria): bool
    {
        return false;
    }
}
