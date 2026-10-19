<?php

namespace Database\Seeders;

use App\Models\TipoCotizacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoCotizacion::create([
            'nombre' => 'Hospedaje',
        ]);

        TipoCotizacion::create([
            'nombre' => 'Materiales',
        ]);

        TipoCotizacion::create([
            'nombre' => 'Equipos',
        ]);

        TipoCotizacion::create([
            'nombre' => 'Examenes medicos',
        ]);

        TipoCotizacion::create([
            'nombre' => 'Herramientas',
        ]);

        TipoCotizacion::create([
            'nombre' => 'EPP',
        ]);

        TipoCotizacion::create([
            'nombre' => 'Alimentos',
        ]);
    }
}
