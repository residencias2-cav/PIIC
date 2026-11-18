<?php

namespace Database\Seeders;

use App\Models\Catalogos\LugarNacimiento;
use App\Models\Catalogos\TipoSangre;
use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lugarNacimiento = LugarNacimiento::where(
            'nombre',
            'Zacatecas'
        )->firstOrFail();

        $tipoSangre = TipoSangre::where(
            'nombre',
            'A+'
        )->firstOrFail();

        Trabajador::firstOrCreate(
            ['nt' => 'TEST-MARCO-01'],
            [
                'nombre' => 'Marco',
                'apellido_paterno' => 'Prueba',
                'apellido_materno' => 'Usuario',
                'sexo' => 'Hombre',
                'nss' => '00000000001',
                'curp' => 'XEXX000000HDFXXX00',
                'rfc' => 'XAXX000000AAA',
                'fecha_nacimiento' => '1990-01-01',
                'lugar_nacimiento_id' => $lugarNacimiento->id,
                'tipo_sangre_id' => $tipoSangre->id,
            ]
        );
    }
}
