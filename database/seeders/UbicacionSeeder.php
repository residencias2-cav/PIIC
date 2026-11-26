<?php

namespace Database\Seeders;

use App\Models\Catalogos\Ubicacion;
use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    public function run(): void
    {
        $ubicaciones = [
            'Oficinas centrales',
            'Almacén general',
            'Proyecto de prueba',
            'Taller de maquinaria',
        ];

        foreach ($ubicaciones as $nombre) {
            Ubicacion::updateOrCreate(
                [
                    'nombre' => $nombre,
                ],
                []
            );
        }
    }
}