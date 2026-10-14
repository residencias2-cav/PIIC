<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estado_pedido extends Model
{
    /** @use HasFactory<\Database\Factories\EstadoPedidoFactory> */
    use HasFactory;

    protected $table = 'estado_pedido';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
