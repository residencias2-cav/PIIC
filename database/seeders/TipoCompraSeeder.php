<?php

namespace Database\Seeders;

use App\Models\TipoCompra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoCompra::create([
            'nombre' => 'General',
        ]);

        TipoCompra::create([
            'nombre' => 'Agencias',
        ]);

        TipoCompra::create([
            'nombre' => 'Toner',
        ]);

        TipoCompra::create([
            'nombre' => 'Papeleria',
        ]);

        TipoCompra::create([
            'nombre' => 'Examenes medicos',
        ]);

        TipoCompra::create([
            'nombre' => 'Productos',
        ]);

        TipoCompra::create([
            'nombre' => 'EPP',
        ]);

        TipoCompra::create([
            'nombre' => 'Insumos',
        ]);

        TipoCompra::create([
            'nombre' => 'Productos de limpieza',
        ]);
    }
}
