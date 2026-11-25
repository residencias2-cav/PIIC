<?php

namespace Database\Seeders;

use App\Models\Catalogos\TipoUsuario;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposUsuario = [
            'ADMIN',
            'Director',
            'Supervisor',
            'Gerente',
            'Operativo',
            'Administrativo',
            'Invitado',
            'Proveedor',
            'Compras',
        ];

        foreach ($tiposUsuario as $nombre) {
            TipoUsuario::updateOrCreate(
                [
                    'nombre' => $nombre,
                ],
                []
            );
        }
    }
}