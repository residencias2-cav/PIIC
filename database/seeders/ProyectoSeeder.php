<?php

namespace Database\Seeders;

use App\Models\Catalogos\Proyecto;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    public function run(): void
    {
        $proyectos = [
            'Proyecto PIIC de Prueba',
            'Construcción Administrativa de Prueba',
            'Mantenimiento General de Prueba',
        ];

        foreach ($proyectos as $nombre) {
            Proyecto::updateOrCreate(
                [
                    'nombre' => $nombre,
                ],
                []
            );
        }
    }
}