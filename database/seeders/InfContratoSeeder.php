<?php

namespace Database\Seeders;

use App\Models\InfContrato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InfContrato::create([
            'tipo_contrato' => 'Compra-venta',
        ]);

        InfContrato::create([
            'tipo_contrato' => 'Servicios',
        ]);

        InfContrato::create([
            'tipo_contrato' => 'REPSE',
        ]);

        InfContrato::create([
            'tipo_contrato' => 'Arrendamiento',
        ]);

        InfContrato::create([
            'tipo_contrato' => 'N/A',
        ]);
    }
}
