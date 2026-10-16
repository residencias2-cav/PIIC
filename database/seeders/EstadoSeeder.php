<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estado::create([
            'nombre' => 'Autorizado',
        ]);

        Estado::create([
            'nombre' => 'Surtido',
        ]);

        Estado::create([
            'nombre' => 'En_espera',
        ]);

        Estado::create([
            'nombre' => 'Enviado',
        ]);

        Estado::create([
            'nombre' => 'Recibido',
        ]);
        
        Estado::create([
            'nombre' => 'Cancelado',
        ]);
    }
}
