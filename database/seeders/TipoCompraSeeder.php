<?php

namespace Database\Seeders;

use App\Models\Catalogos\TipoCompra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipocompras = [
            'General',
            'Agencias',
            'Toner',
            'Papeleria',
            'Examenes medicos',
            'Productos',
            'Epp',
            'Insumos',
            'Productos de limpieza'
        ];

        foreach ($tipocompras as $nombre) {
                TipoCompra::firstOrCreate([
                    'nombre' => $nombre
                ]);

        }
    }
}