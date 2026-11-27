<?php

namespace App\Providers;

use App\Models\Usuarios\Usuario;
use App\Services\EmailTwoFactorService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;
use App\Services\EmailTwoFactorPolicy;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Respuesta personalizada después del login
        |--------------------------------------------------------------------------
        |
        | Fortify ya comprobó usuario y contraseña cuando se ejecuta esta
        | respuesta. Si el usuario tiene 2FA por correo habilitado, cerramos
        | la autenticación provisional y lo enviamos al challenge.
        |
        */

        $this->app->singleton(
        LoginResponse::class,
        function ($app) {
            return new class(
                $app->make(EmailTwoFactorService::class),
                $app->make(EmailTwoFactorPolicy::class)
            ) implements LoginResponse {

                public function __construct(
                    private readonly EmailTwoFactorService $twoFactorService,
                    private readonly EmailTwoFactorPolicy $twoFactorPolicy
                ) {
                }

                public function toResponse($request)
                {
                    /** @var Usuario|null $usuario */
                    $usuario = Auth::user();

                    if (! $usuario) {
                        return redirect()
                            ->route('login')
                            ->withErrors([
                                'usuario' =>
                                    'No fue posible completar la autenticación.',
                            ]);
                    }

                    /*
                    * La política central de 2FA decide
                    * si esta cuenta necesita challenge.
                    */
                    if (
                        ! $this->twoFactorPolicy
                            ->requiresChallenge($usuario)
                    ) {
                        return redirect()->intended(
                            config(
                                'fortify.home',
                                '/panel'
                            )
                        );
                    }

                    $usuarioId = $usuario->getKey();

                    $recordar = $request->boolean(
                        'remember'
                    );

                    /*
                    * Se cierra el login provisional.
                    */
                    Auth::guard(
                        config(
                            'fortify.guard',
                            'web'
                        )
                    )->logout();

                    /*
                    * Se conserva el usuario pendiente
                    * de completar 2FA.
                    */
                    $request->session()->put([
                        'email_2fa_user_id' =>
                            $usuarioId,

                        'email_2fa_remember' =>
                            $recordar,

                        'email_2fa_started_at' =>
                            now()->timestamp,
                    ]);

                    try {
                        $this->twoFactorService
                            ->sendCode($usuario);
                    } catch (\Throwable $exception) {
                        $request->session()->forget([
                            'email_2fa_user_id',
                            'email_2fa_remember',
                            'email_2fa_started_at',
                        ]);

                        report($exception);

                        return redirect()
                            ->route('login')
                            ->withErrors([
                                'usuario' =>
                                    'No fue posible generar el código de verificación. Inténtalo nuevamente.',
                            ]);
                    }

                    return redirect()->route(
                        'email-2fa.challenge'
                    );
                }
            };
        }
    );

        /*
        |--------------------------------------------------------------------------
        | Respuesta personalizada después del logout
        |--------------------------------------------------------------------------
        */

        $this->app->singleton(
            LogoutResponse::class,
            function () {
                return new class implements LogoutResponse {
                    public function toResponse($request)
                    {
                        $request->session()->forget([
                            'email_2fa_user_id',
                            'email_2fa_remember',
                            'email_2fa_started_at',
                        ]);

                        return redirect()->route('login');
                    }
                };
            }
        );
    }

    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Autenticación personalizada
        |--------------------------------------------------------------------------
        */

        Fortify::authenticateUsing(
            function (Request $request) {
                $usuario = Usuario::where(
                    'usuario',
                    $request->input('usuario')
                )->first();

                if (
                    $usuario
                    && Hash::check(
                        $request->input('password'),
                        $usuario->contrasena
                    )
                ) {
                    return $usuario;
                }

                return null;
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Limitador del login
        |--------------------------------------------------------------------------
        */

        RateLimiter::for(
            'login',
            function (Request $request) {
                $usuario = Str::lower(
                    (string) $request->input(
                        'usuario'
                    )
                );

                return Limit::perMinute(5)->by(
                    $usuario.'|'.$request->ip()
                );
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Vistas de Fortify
        |--------------------------------------------------------------------------
        */

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::confirmPasswordView(function () {
            return view('auth.confirm-password');
        });
    }
}