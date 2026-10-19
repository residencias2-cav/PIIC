<?php

namespace Database\Seeders;

use App\Models\TipoOficio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoOficioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoOficio::create([
            'nombre' => 'Oficios producto',
        ]);

        TipoOficio::create([
            'nombre' => 'Oficios repse',
        ]);

        TipoOficio::create([
            'nombre' => 'Oficios rutas',
        ]);

        TipoOficio::create([
            'nombre' => 'Oficios comisiones',
        ]);
    }
}
