<?php

namespace Database\Seeders;

use App\Models\Catalogos\TipoPedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipopedido = [
                'Pedido general',
                'Pedido interno',
                'Pedido almacen'
            ];

        foreach ($tipopedido as $nombre) {
                TipoPedido::firstOrCreate([
                    'nombre' => $nombre
                ]);
        }
    }
}
