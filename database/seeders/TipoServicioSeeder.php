<?php

namespace Database\Seeders;

use App\Models\TipoServicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoServicio::create([
            'nombre' => 'Mantenimientos',
        ]);

        TipoServicio::create([
            'nombre' => 'Maquinaria',
        ]);

        TipoServicio::create([
            'nombre' => 'Vehiculo(s)',
        ]);

        TipoServicio::create([
            'nombre' => 'Transporte especial',
        ]);
    }
}
