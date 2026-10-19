<?php

namespace Database\Seeders;

use App\Models\Articulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Articulo::create([
            'nombre' => 'Pantalon',
        ]);

        Articulo::create([
            'nombre' => 'Camisa',
        ]);

        Articulo::create([
            'nombre' => 'Botas',
        ]);

        Articulo::create([
            'nombre' => 'Zapatos',
        ]);

        Articulo::create([
            'nombre' => 'Chaleco',
        ]);

        Articulo::create([
            'nombre' => 'Casco',
        ]);

        Articulo::create([
            'nombre' => 'Guantes',
        ]);

        Articulo::create([
            'nombre' => 'Lentes',
        ]);

        Articulo::create([
            'nombre' => 'Overol',
        ]);

        Articulo::create([
            'nombre' => 'Bata',
        ]);
    }
}
