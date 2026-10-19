<?php

namespace Database\Seeders;

use App\Models\TipoPedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoPedido::create([
            'nombre' => 'Pedido general',
        ]);

        TipoPedido::create([
            'nombre' => 'Pedido interno',
        ]);

        TipoPedido::create([
            'nombre' => 'Pedido almacen',
        ]);
    }
}
