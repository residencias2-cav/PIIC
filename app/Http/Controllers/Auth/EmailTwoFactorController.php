<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuarios\Usuario;
use App\Services\EmailTwoFactorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Enums\EmailTwoFactorResult;

class EmailTwoFactorController extends Controller
{
    /**
     * Mostrar el formulario de verificación.
     */
    public function show(
        Request $request
    ): View|RedirectResponse {
        if (
            ! $request->session()->has(
                'email_2fa_user_id'
            )
        ) {
            return redirect()->route('login');
        }

        return view(
            'auth.email-two-factor-challenge'
        );
    }

    /**
     * Verificar el código recibido por correo.
     */
    public function verify(
        Request $request,
        EmailTwoFactorService $service
    ): RedirectResponse {
        $datos = $request->validate([
            'codigo' => [
                'required',
                'digits:6',
            ],
        ]);

        $usuarioId = $request->session()->get(
            'email_2fa_user_id'
        );

        if (! $usuarioId) {
            return redirect()->route('login');
        }

        $usuario = Usuario::find($usuarioId);

        if (! $usuario) {
            $this->limpiarSesionPendiente(
                $request
            );

            return redirect()->route('login');
        }

        $resultado = $service->verifyCode(
            $usuario,
            $datos['codigo']
        );

        if (
            $resultado
            !== EmailTwoFactorResult::VALIDO
        ) {
            $mensaje = match ($resultado) {
                EmailTwoFactorResult::INCORRECTO =>
                    'El código ingresado es incorrecto.',

                EmailTwoFactorResult::EXPIRADO =>
                    'El código ha expirado. Solicita uno nuevo.',

                EmailTwoFactorResult::LIMITE_INTENTOS =>
                    'Has alcanzado el límite de intentos. Solicita un nuevo código.',

                EmailTwoFactorResult::SIN_CODIGO =>
                    'No hay un código de verificación activo. Solicita uno nuevo.',

                default =>
                    'No fue posible verificar el código.',
            };

            return back()
                ->withErrors([
                    'codigo' => $mensaje,
                ])
                ->onlyInput('codigo');
        }

        $recordar = (bool) $request
            ->session()
            ->get(
                'email_2fa_remember',
                false
            );

        Auth::guard(
            config('fortify.guard', 'web')
        )->login(
            $usuario,
            $recordar
        );

        $request->session()->regenerate();

        $this->limpiarSesionPendiente(
            $request
        );

        return redirect()->intended(
            config('fortify.home', '/panel')
        );
    }

    /**
     * Generar y enviar un código nuevo.
     */
    public function resend(
        Request $request,
        EmailTwoFactorService $service
    ): RedirectResponse {
        $usuarioId = $request->session()->get(
            'email_2fa_user_id'
        );

        if (! $usuarioId) {
            return redirect()->route('login');
        }

        $usuario = Usuario::find($usuarioId);

        if (! $usuario) {
            $this->limpiarSesionPendiente(
                $request
            );

            return redirect()->route('login');
        }

        $service->sendCode($usuario);

        return back()->with(
            'status',
            'Se generó un nuevo código de verificación.'
        );
    }

    /**
     * Cancelar el desafío y volver al login.
     */
    public function cancel(
        Request $request,
        EmailTwoFactorService $service
    ): RedirectResponse {
        $usuarioId = $request->session()->get(
            'email_2fa_user_id'
        );

        if ($usuarioId) {
            $usuario = Usuario::find(
                $usuarioId
            );

            if ($usuario) {
                $service->invalidateCode(
                    $usuario
                );
            }
        }

        $this->limpiarSesionPendiente(
            $request
        );

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Eliminar información temporal del challenge.
     */
    private function limpiarSesionPendiente(
        Request $request
    ): void {
        $request->session()->forget([
            'email_2fa_user_id',
            'email_2fa_remember',
            'email_2fa_started_at',
        ]);
    }
}