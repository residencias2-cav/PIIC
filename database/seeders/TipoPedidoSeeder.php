<?php

namespace Database\Seeders;

use App\Models\Catalogos\TipoPedido;
use Illuminate\Database\Seeder;

class TipoPedidoSeeder extends Seeder
{
    public function run(): void
    {
        $tiposPedido = [
            'Pedido general',
            'Pedido interno',
            'Pedido almacen',
        ];

        foreach ($tiposPedido as $nombre) {
            TipoPedido::updateOrCreate(
                [
                    'nombre' => $nombre,
                ],
                []
            );
        }
    }
}