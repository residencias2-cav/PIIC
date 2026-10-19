<?php

namespace Database\Seeders;

use App\Models\TipoSangre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSangreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoSangre::create([
            'nombre' => 'A+',
        ]);

        TipoSangre::create([
            'nombre' => 'A-',
        ]);

        TipoSangre::create([
            'nombre' => 'B+',
        ]);

        TipoSangre::create([
            'nombre' => 'B-',
        ]);

        TipoSangre::create([
            'nombre' => 'AB+',
        ]);

        TipoSangre::create([
            'nombre' => 'AB-',
        ]);

        TipoSangre::create([
            'nombre' => 'O+',
        ]);

        TipoSangre::create([
            'nombre' => 'O-',
        ]);
    }
}
