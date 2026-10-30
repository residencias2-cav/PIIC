<?php

namespace Database\Seeders;

use App\Models\Catalogos\TipoSangre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSangreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $tiposangre = [
        'A+',
        'A-',
        'B+',
        'B-',
        'AB+',
        'AB-',
        'O+',
        'O-'
        ];

        foreach ($tiposangre as $nombre) {
                TipoSangre::firstOrCreate([
                    'nombre' => $nombre
                ]);
        }
    }
}
