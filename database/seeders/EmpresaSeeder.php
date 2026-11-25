<?php

namespace Database\Seeders;

use App\Models\Catalogos\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresas = [
            [
                'nombre' => 'Empresa PIIC Pruebas',
                'rfc' => 'EPP261125T01',
                'dom_fiscal' => 'Domicilio fiscal ficticio, Sombrerete, Zacatecas.',
            ],
            [
                'nombre' => 'Construcciones Pruebas del Centro',
                'rfc' => 'CPC261125T02',
                'dom_fiscal' => 'Domicilio fiscal ficticio, Zacatecas, Zacatecas.',
            ],
        ];

        foreach ($empresas as $empresa) {
            Empresa::updateOrCreate(
               [
                    'rfc' => $empresa['rfc'],
                ],
                [
                    'nombre' => $empresa['nombre'],
                    'dom_fiscal' => $empresa['dom_fiscal'],
                ]
            );
        }    
    }
}