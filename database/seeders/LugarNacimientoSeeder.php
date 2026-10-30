<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Catalogos\LugarNacimiento;

class LugarNacimientoSeeder extends Seeder
{

    public function run()
    {
        $estadosMexicanos = [
        "Aguascalientes",
        "Baja California",
        "Baja California Sur",
        "Campeche",
        "Chiapas",
        "Chihuahua",
        "Ciudad de México",
        "Coahuila",
        "Colima",
        "Durango",
        "Estado de México",
        "Guanajuato",
        "Guerrero",
        "Hidalgo",
        "Jalisco",
        "Michoacán",
        "Morelos",
        "Nayarit",
        "Nuevo León",
        "Oaxaca",
        "Puebla",
        "Querétaro",
        "Quintana Roo",
        "San Luis Potosí",
        "Sinaloa",
        "Sonora",
        "Tabasco",
        "Tamaulipas",
        "Tlaxcala",
        "Veracruz",
        "Yucatán",
        "Zacatecas"
        ];

    foreach ($estadosMexicanos as $estado) {
            LugarNacimiento::firstOrCreate([
                'nombre' => $estado
            ]);
        }
    }
}
