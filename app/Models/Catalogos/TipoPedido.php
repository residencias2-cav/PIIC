<?php

namespace App\Models;

use App\Models\Compras\Pedido;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoPedido extends Model
{
    /** @use HasFactory<\Database\Factories\TipoPedidoFactory> */
    use HasFactory;

    protected $table = 'tipo_pedidos';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
