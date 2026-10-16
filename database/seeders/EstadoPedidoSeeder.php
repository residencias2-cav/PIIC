<?php

namespace Database\Seeders;

use App\Models\EstadoPedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoPedido::create([
            'nombre' => 'Cotizado',
        ]);

        EstadoPedido::create([
            'nombre' => 'Enviado',
        ]);

        EstadoPedido::create([
            'nombre' => 'Revisar notas',
        ]);
    }
}
