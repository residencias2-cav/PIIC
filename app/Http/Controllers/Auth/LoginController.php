<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuarios\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $datos = $request->validate(
            [
                'usuario' => [
                    'required',
                    'string',
                ],

                'password' => [
                    'required',
                    'string',
                ],
            ],
            [
                'usuario.required' =>
                    'El usuario es obligatorio.',

                'password.required' =>
                    'La contraseña es obligatoria.',
            ]
        );

        $usuario = Usuario::where(
            'usuario',
            $datos['usuario']
        )->first();

        if (
            !$usuario ||
            !Hash::check(
                $datos['password'],
                $usuario->contraseña_correo
            )
        ) {
            return back()
                ->withErrors([
                    'usuario' =>
                        'El usuario o la contraseña son incorrectos.',
                ])
                ->onlyInput('usuario');
        }

        Auth::login(
            $usuario,
            $request->boolean('remember')
        );

        $request->session()->regenerate();

        return redirect()
            ->route('inicio');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }
}