<?php

namespace Database\Seeders;

use App\Models\Catalogos\Gerencia;
use App\Models\Catalogos\TipoUsuario;
use App\Models\Usuarios\Trabajador;
use App\Models\Usuarios\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = env(
            'SEED_TEST_PASSWORD',
            'PIIC-Pruebas-2026!'
        );

        /*
         * Conserva la cuenta personal que ya utilizabas.
         */
        $this->crearUsuario(
            usuario: 'uMarco2026',
            nt: 'TEST-MARCO-01',
            gerenciaCode: 'GTI',
            tipoUsuario: 'Supervisor',
            correo: 'amadorantonio169@gmail.com',
            password: $password
        );

        /*
         * Crea Supervisor y Gerente para cada
         * gerencia operativa.
         */
        $gerenciasOperativas = Gerencia::query()
            ->whereNotIn('code', [
                'Subdir',
            ])
            ->orderBy('id')
            ->get();

        foreach ($gerenciasOperativas as $gerencia) {
            $codigoUsuario = $this->normalizarCodigo(
                $gerencia->code
            );

            $this->crearUsuario(
                usuario: 'sup_'.$codigoUsuario,
                nt: substr(
                    'SUP-'.strtoupper($gerencia->code),
                    0,
                    15
                ),
                gerenciaCode: $gerencia->code,
                tipoUsuario: 'Supervisor',
                correo:
                    'sup.'.$codigoUsuario.'@piic.test',
                password: $password
            );

            $this->crearUsuario(
                usuario: 'ger_'.$codigoUsuario,
                nt: substr(
                    'GER-'.strtoupper($gerencia->code),
                    0,
                    15
                ),
                gerenciaCode: $gerencia->code,
                tipoUsuario: 'Gerente',
                correo:
                    'ger.'.$codigoUsuario.'@piic.test',
                password: $password
            );
        }

        /*
         * Director/SUBDIR con consulta general.
         */
        $this->crearUsuario(
            usuario: 'director_subdir',
            nt: 'DIR-SUBDIR',
            gerenciaCode: 'Subdir',
            tipoUsuario: 'Director',
            correo: 'director@piic.test',
            password: $password
        );

        /*
         * Cuenta del departamento de Compras.
         */
        $this->crearUsuario(
            usuario: 'usuario_compras',
            nt: 'COM-GCOMP',
            gerenciaCode: 'GComp',
            tipoUsuario: 'Compras',
            correo: 'compras@piic.test',
            password: $password
        );

        /*
         * Administrador central.
         */
        $this->crearUsuario(
            usuario: 'admin_piic',
            nt: 'ADM-GTI',
            gerenciaCode: 'GTI',
            tipoUsuario: 'ADMIN',
            correo: 'admin@piic.test',
            password: $password
        );

        if ($this->command) {
            $this->command->newLine();

            $this->command->info(
                'Usuarios de prueba creados.'
            );

            $this->command->info(
                'Contraseña común: '.$password
            );

            $this->command->warn(
                'Estas cuentas son únicamente para desarrollo.'
            );
        }
    }

    /**
     * Crea o actualiza una cuenta de prueba.
     */
    private function crearUsuario(
        string $usuario,
        string $nt,
        string $gerenciaCode,
        string $tipoUsuario,
        string $correo,
        string $password
    ): void {
        $trabajador = Trabajador::where(
            'nt',
            $nt
        )->firstOrFail();

        $gerencia = Gerencia::where(
            'code',
            $gerenciaCode
        )->firstOrFail();

        $tipo = TipoUsuario::where(
            'nombre',
            $tipoUsuario
        )->firstOrFail();

        Usuario::updateOrCreate(
            [
                'usuario' => substr(
                    $usuario,
                    0,
                    20
                ),
            ],
            [
                'trabajador_id' =>
                    $trabajador->id,

                'gerencia_id' =>
                    $gerencia->id,

                'tipo_usuario_id' =>
                    $tipo->id,

                'tipos_usuario_ch' => false,

                /*
                 * Usuario tiene el cast:
                 * 'contrasena' => 'hashed'
                 */
                'contrasena' => $password,

                'correo' => substr(
                    $correo,
                    0,
                    50
                ),

                /*
                 * La contraseña del correo no se
                 * almacena para estas cuentas.
                 */
                'password' => null,
            ]
        );
    }

    /**
     * Convierte el código de gerencia en un valor
     * seguro para usuario y correo ficticio.
     */
    private function normalizarCodigo(
        string $codigo
    ): string {
        return strtolower(
            preg_replace(
                '/[^a-zA-Z0-9]/',
                '',
                $codigo
            )
        );
    }
}