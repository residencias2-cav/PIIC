<?php

namespace Database\Seeders;

use App\Models\Catalogos\Gerencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GerenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gerencia::create([
            'nombre' => 'Maquinaria y Transporte',
            'code' => 'MyT',
        ]);

        Gerencia::create([
            'nombre' => 'Compras',
            'code' => 'GComp',
        ]);

        Gerencia::create([
            'nombre' => 'Subdirector',
            'code' => 'Subdir',
        ]);

        Gerencia::create([
            'nombre' => 'Contabilidad',
            'code' => 'GCI',
        ]);

        Gerencia::create([
            'nombre' => 'Proyectos y Construccion',
            'code' => 'GPC',
        ]);

        Gerencia::create([
            'nombre' => 'Licitaciones y Proyectos',
            'code' => 'GLP',
        ]);

        Gerencia::create([
            'nombre' => 'Capital Humano',
            'code' => 'GCHSO',
        ]);

        Gerencia::create([
            'nombre' => 'Finanzas',
            'code' => 'GF',
        ]);

        Gerencia::create([
            'nombre' => 'Seguridad',
            'code' => 'GSST',
        ]);
    }
}
