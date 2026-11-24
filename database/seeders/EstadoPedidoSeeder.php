<?php

namespace Database\Seeders;

use App\Models\Catalogos\EstadoPedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estadop = [
            'Cotizado',
            'Enviado',
            'Revisar notas',
            'Borrador',
            'Pendiente de gerencia',
            'Rechazado',
            'Autorizado',
            'Enviado a Compras',
            'En proceso',
            'Atendido',
            'Cancelado',
        ];

        foreach ($estadop as $nombre) {
            EstadoPedido::firstOrCreate([
                'nombre' => $nombre,
            ]);
        }
    }
}