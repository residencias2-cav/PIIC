<?php

namespace Database\Seeders;

use App\Models\Catalogos\TipoEpp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoEppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $tipoepp = [
                'EPP Ex',
                'EPP Tr',
                'EPP Re',
                'EPP Ni',
                'EPP Rc'
            ];

        foreach ($tipoepp as $nombre) {
                TipoEpp::firstOrCreate([
                    'nombre' => $nombre
                ]);
        }
    }
}
