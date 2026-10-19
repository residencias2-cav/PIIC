<?php

namespace Database\Seeders;

use App\Models\TipoEpp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoEppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoEpp::create([
            'nombre' => 'EPP ex',
        ]);

        TipoEpp::create([
            'nombre' => 'EPP tr',
        ]);

        TipoEpp::create([
            'nombre' => 'EPP re',
        ]);

        TipoEpp::create([
            'nombre' => 'EPP ni',
        ]);

        TipoEpp::create([
            'nombre' => 'EPP rc',
        ]);
    }
}
