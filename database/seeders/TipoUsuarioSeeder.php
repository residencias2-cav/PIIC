<?php

namespace Database\Seeders;

use App\Models\Catalogos\TipoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipousuario = [
                'Director',
                'Supervisor',
                'Gerente',
                'Operativo',
                'Administrativo',
                'Invitado',
                'Proveedor',
                'Compras'
            ];

        foreach ($tipousuario as $nombre) {
                TipoUsuario::firstOrCreate([
                    'nombre' => $nombre
                ]);
        }
    }
}
