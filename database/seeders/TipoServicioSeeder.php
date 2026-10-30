<?php

namespace Database\Seeders;

use App\Models\Catalogos\TipoServicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposervicio = [
                'Mantenimientos',
                'Maquinaria',
                'Vehiculo(s)',
                'Transporte especial'
            ];

        foreach ($tiposervicio as $nombre) {
                TipoServicio::firstOrCreate([
                    'nombre' => $nombre
                ]);
        }
    }
}
