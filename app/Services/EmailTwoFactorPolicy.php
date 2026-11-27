<?php

namespace App\Services;

use App\Models\Usuarios\Usuario;
use Illuminate\Support\Carbon;

class EmailTwoFactorPolicy
{
    /**
     * Determina si el usuario debe completar
     * el segundo factor para iniciar sesión.
     */
    public function requiresChallenge(
        Usuario $usuario
    ): bool {
        return $usuario->email_2fa_enabled;
    }
}