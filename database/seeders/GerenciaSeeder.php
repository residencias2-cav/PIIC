<?php

namespace Database\Seeders;

use App\Models\Catalogos\Gerencia;
use Illuminate\Database\Seeder;

class GerenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gerencias = [
            [
                'nombre' => 'Tecnologías de la Información',
                'code' => 'GTI',
            ],
            [
                'nombre' => 'Maquinaria y Transporte',
                'code' => 'MyT',
            ],
            [
                'nombre' => 'Compras',
                'code' => 'GComp',
            ],
            [
                'nombre' => 'Subdirección',
                'code' => 'Subdir',
            ],
            [
                'nombre' => 'Contabilidad',
                'code' => 'GCI',
            ],
            [
                'nombre' => 'Proyectos y Construcción',
                'code' => 'GCP',
            ],
            [
                'nombre' => 'Licitaciones y Proyectos',
                'code' => 'GLP',
            ],
            [
                'nombre' => 'Capital Humano',
                'code' => 'GCHSO',
            ],
            [
                'nombre' => 'Finanzas',
                'code' => 'GF',
            ],
            [
                'nombre' => 'Seguridad',
                'code' => 'GSST',
            ],

            /*
             * Departamentos identificados en el sistema heredado
             * y todavía no representados directamente arriba.
             */
            [
                'nombre' => 'Concretos',
                'code' => 'CONCRETOS',
            ],
            [
                'nombre' => 'Dirección Legal y Administrativa',
                'code' => 'DLyA',
            ],
            [
                'nombre' => 'Dirección de Operaciones y Construcción',
                'code' => 'DOPACV',
            ],
            [
                'nombre' => 'Gerencia de Construcción y Supervisión',
                'code' => 'GCSO1',
            ],
            [
                'nombre' => 'Gerencia de Obra Civil',
                'code' => 'GOC',
            ],
            [
                'nombre' => 'Nóminas',
                'code' => 'NOMINAS',
            ],
        ];

        foreach ($gerencias as $gerencia) {
            Gerencia::updateOrCreate(
                [
                    'code' => $gerencia['code'],
                ],
                [
                    'nombre' => $gerencia['nombre'],
                ]
            );
        }
    }
}