<?php

namespace App\Providers;

use App\Models\Usuarios\Usuario;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Autenticación personalizada
        |--------------------------------------------------------------------------
        */

        Fortify::authenticateUsing(function (Request $request) {

            $usuario = Usuario::where(
                'usuario',
                $request->input('usuario')
            )->first();

            if (
                $usuario &&
                Hash::check(
                    $request->input('password'),
                    $usuario->contrasena
                )
            ) {
                return $usuario;
            }

            return null;
        });


        /*
        |--------------------------------------------------------------------------
        | Rate Limiter - Login
        |--------------------------------------------------------------------------
        */

        RateLimiter::for('login', function (Request $request) {

            $usuario = Str::lower(
                (string) $request->input('usuario')
            );

            return Limit::perMinute(5)->by(
                $usuario.'|'.$request->ip()
            );
        });


        /*
        |--------------------------------------------------------------------------
        | Rate Limiter - Two Factor
        |--------------------------------------------------------------------------
        */

        RateLimiter::for('two-factor', function (Request $request) {

            return Limit::perMinute(5)->by(
                (string) $request->session()->get('login.id')
            );
        });


        /*
        |--------------------------------------------------------------------------
        | Vistas
        |--------------------------------------------------------------------------
        */

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge');
        });

        Fortify::confirmPasswordView(function () {
            return view('auth.confirm-password');
        });
    }
}