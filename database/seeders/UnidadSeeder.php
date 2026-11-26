<?php

namespace Database\Seeders;

use App\Models\Catalogos\Unidad;
use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    public function run(): void
    {
        $unidades = [
            'Pieza',
            'Caja',
            'Paquete',
            'Litro',
            'Kilogramo',
            'Metro',
            'Juego',
            'Lote',
            'Servicio',
        ];

        foreach ($unidades as $nombre) {
            Unidad::updateOrCreate(
                [
                    'nombre' => $nombre,
                ],
                []
            );
        }
    }
}