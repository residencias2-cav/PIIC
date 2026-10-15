<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado_Pedido extends Model
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

    public function estados_pedido()
    {
        return $this->hasMany(Cotizacion::class);
    }
}
