<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_pedido extends Model
{
    /** @use HasFactory<\Database\Factories\TipoPedidoFactory> */
    use HasFactory;

    protected $table = 'tipo_pedido';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
