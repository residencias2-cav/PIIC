<?php

namespace App\Models\Catalogos;

use App\Models\Compras\Cotizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstadoPedido extends Model
{
    /** @use HasFactory<\Database\Factories\EstadoPedidoFactory> */
    use HasFactory;

    protected $table = 'estado_pedidos';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function estadosPedido()
    {
        return $this->hasMany(Cotizacion::class);
    }
}
