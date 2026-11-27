<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuarios\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SeguridadUsuarioController extends Controller
{
    public function actualizarDosFactores(
        Request $request,
        Usuario $usuario
    ): RedirectResponse {
        Gate::authorize(
            'administrar-usuarios'
        );

        $datos = $request->validate([
            'email_2fa_enabled' => [
                'required',
                'boolean',
            ],
        ]);

        $usuario->forceFill([
            'email_2fa_enabled' =>
                $datos['email_2fa_enabled'],
        ])->save();

        return back()->with(
            'success',
            $datos['email_2fa_enabled']
                ? 'El segundo factor fue activado para el usuario.'
                : 'El segundo factor fue desactivado para el usuario.'
        );
    }
}