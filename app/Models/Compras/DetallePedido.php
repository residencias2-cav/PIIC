<?php

namespace App\Models\Compras;

use App\Models\Catalogos\Unidad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetallePedido extends Model
{
    /** @use HasFactory<\Database\Factories\DetallePedidoFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'detalle_pedidos';

    protected $fillable = [
        'pedido_id',
        'partida',
        'cantidad',
        'unidad_id',
        'descripcion',
        'uso',
        'credito',
        'fecha_pago',
        'codigo',
    ];

    protected function casts(): array
    {
        return [
            'partida' => 'integer',
            'cantidad' => 'integer',
            'credito' => 'boolean',
            'fecha_pago' => 'date',
        ];
    }

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}
