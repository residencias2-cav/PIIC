<?php

namespace Database\Seeders;

use App\Models\Catalogos\TipoOficio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoOficioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipooficios = [
            'Oficios producto',
            'Oficios RepSe',
            'Oficios rutas',
            'Oficios comisiones' 
            ];

        foreach ($tipooficios as $nombre) {
                TipoOficio::firstOrCreate([
                    'nombre' => $nombre
                ]);
        }
    }
}
