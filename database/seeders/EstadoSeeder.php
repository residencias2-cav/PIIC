<?php

namespace Database\Seeders;

use App\Models\Catalogos\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estado = [
            'Autorizado',
            'Surtido',
            'En espera',
            'Enviado',
            'Recibido',
            'Cancelado',
        ];

        foreach ($estado as $nombre) {
            Estado::firstOrCreate([
                'nombre_estado' => $nombre,
            ]);
        }
    }
}
