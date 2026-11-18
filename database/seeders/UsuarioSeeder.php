<?php

namespace Database\Seeders;

use App\Models\Catalogos\Gerencia;
use App\Models\Catalogos\TipoUsuario;
use App\Models\Usuarios\Trabajador;
use App\Models\Usuarios\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario = Usuario::firstOrNew([
            'usuario' => 'uMarco2026',
        ]);

        if ($usuario->exists) {
            return;
        }

        $trabajador = Trabajador::where(
            'nt',
            'TEST-MARCO-01'
        )->firstOrFail();

        $gerencia = Gerencia::where(
            'code',
            'GTI'
        )->firstOrFail();

        $tipoUsuario = TipoUsuario::where(
            'nombre',
            'Supervisor'
        )->firstOrFail();

        $password = Str::random(24);

        $usuario->fill([
            'trabajador_id' => $trabajador->id,
            'gerencia_id' => $gerencia->id,
            'tipo_usuario_id' => $tipoUsuario->id,
            'tipos_usuario_ch' => false,
            'contrasena' => 'TEST-ONLY',
            'correo' => 'amadorantonio169@gmail.com',
            'contrasena_correo' => Hash::make($password),
            'twofa_code' => Str::random(32),
            'twofa_expire' => now()->addDay()->toDateString(),
            'twofa_attempts' => 0,
        ]);

        if (Schema::hasColumn('usuarios', 'remember_token')) {
            $usuario->setAttribute('remember_token', Str::random(60));
        }

        $usuario->save();

        if ($this->command) {
            $this->command->info('Test account username: uMarco2026');
            $this->command->info('Temporary password: '.$password);
        }
    }
}
