<?php

namespace App\Providers;

use App\Models\Compras\Pedido;
use App\Models\Usuarios\Usuario;
use App\Policies\Compras\PedidoPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Acceso global del administrador
        |--------------------------------------------------------------------------
        |
        | Antes de ejecutar cualquier Gate o Policy, Laravel comprobará
        | si el usuario autenticado es administrador.
        |
        | Si es administrador, se autoriza la operación.
        | Si no lo es, se devuelve null para que Laravel continúe evaluando
        | la Policy o el Gate correspondiente.
        |
        */

        Gate::before(function (
            Usuario $usuario,
            string $ability
        ): ?bool {
            if ($usuario->esAdmin()) {
                return true;
            }

            return null;
        });

        /*
        |--------------------------------------------------------------------------
        | Registro de Policies
        |--------------------------------------------------------------------------
        |
        | Se relaciona cada modelo principal con la Policy responsable
        | de decidir las operaciones que puede realizar cada usuario.
        |
        */

        Gate::policy(
            Pedido::class,
            PedidoPolicy::class
        );

        /*
        |--------------------------------------------------------------------------
        | Capacidades generales del sistema
        |--------------------------------------------------------------------------
        |
        | Estos Gates se utilizan para operaciones generales que no dependen
        | de un registro específico.
        |
        | El administrador puede realizarlas porque Gate::before() devuelve
        | true antes de ejecutar estas reglas.
        |
        */

        Gate::define(
            'administrar-usuarios',
            function (Usuario $usuario): bool {
                return false;
            }
        );

        Gate::define(
            'administrar-catalogos',
            function (Usuario $usuario): bool {
                return false;
            }
        );

        Gate::define(
            'consulta-global',
            function (Usuario $usuario): bool {
                return $usuario->esConsultaGlobal();
            }
        );
    }
}