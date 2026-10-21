<?php

namespace Database\Seeders;

use App\Models\Estado;
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
            'nombre_estado' => 'Autorizado',
        ]);

        Estado::create([
            'nombre_estado' => 'Surtido',
        ]);

        Estado::create([
            'nombre_estado' => 'En espera',
        ]);

        Estado::create([
            'nombre_estado' => 'Enviado',
        ]);

        Estado::create([
            'nombre_estado' => 'Recibido',
        ]);

        Estado::create([
            'nombre_estado' => 'Cancelado',
        ]);
    }
}
