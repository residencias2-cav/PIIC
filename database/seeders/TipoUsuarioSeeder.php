<?php

namespace Database\Seeders;

use App\Models\TipoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoUsuario::create([
            'nombre' => 'Director',
        ]);

        TipoUsuario::create([
            'nombre' => 'Supervisor',
        ]);

        TipoUsuario::create([
            'nombre' => 'Gerente',
        ]);

        TipoUsuario::create([
            'nombre' => 'Operativo',
        ]);

        TipoUsuario::create([
            'nombre' => 'Administrativo',
        ]);

        TipoUsuario::create([
            'nombre' => 'Invitado',
        ]);
    }
}
