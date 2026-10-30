<?php

namespace Database\Seeders;

use App\Models\Catalogos\Articulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
        $articulos = [
            'Pantalon',
            'Botas',
            'Zapatos',
            'Chaleco',
            'Casco',
            'Guantes',
            'Lentes',
            'Overol',
            'Bata',
        ];

        foreach ($articulos as $nombre) {
            Articulo::firstOrCreate([
                'nombre' => $nombre,
            ]);
        }
    }
}
