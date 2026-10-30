<?php

namespace Database\Seeders;

use App\Models\Catalogos\TipoCotizacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $tipocotizacion = [
            'Hospedaje',
            'Materiales',
            'Equipos',
            'Examenes medicos',
            'Herramientas',
            'EPP',
            'Alimentos'
            ];

        foreach ($tipocotizacion as $nombre) {
            TipoCotizacion::firstOrCreate([
                        'nombre' => $nombre
                        ]);

        }
    }
}
