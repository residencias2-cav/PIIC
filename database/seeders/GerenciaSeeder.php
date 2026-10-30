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
        $gerencia = [
            [
                'nombre' => 'Maquinaria y Transporte', 
                'codigo' => 'MyT'
            ],
            [
                'nombre' => 'Compras', 
                'codigo' => 'GComp'
            ],
            [
                'nombre' => 'Subdirector', 
                'codigo' => 'Subdir'
            ],
            [
                'nombre' => 'contabilidad', 
                'codigo' => 'GCI'
            ],
            [
                'nombre' => 'proyectos y Construcción', 
                'codigo' => 'GCP'
            ],
            [
                'nombre' => 'Licitaciones y proyectos', 
                'codigo' => 'GLP'
            ],
            [
                'nombre' => 'Capital Humano', 
                'codigo' => 'GCHSO'
            ],
            [
                'nombre' => 'Finanzas', 
                'codigo' => 'GF'
            ],
            [
                'nombre' => 'seguridad', 
                'codigo' => 'GSST'
            ]
        ];

        foreach ($gerencia as $geren) {
            Gerencia::firstOrCreate(
                [
                    'nombre' => $geren['nombre'],
                ],
                [
                    'code' => $geren['codigo'],
                ]
            );
        }
    }
}