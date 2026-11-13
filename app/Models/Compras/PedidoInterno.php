<?php

namespace App\Models\Compras;

use App\Models\Catalogos\TipoServicio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoInterno extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoInternoFactory> */
    use HasFactory;

    protected $table = 'pedido_internos';

    protected $fillable = [
        'pedido_id',
        'tipo_servicio_id',
        'descripcion',
        'fecha_devolucion',
        'fecha_entrega'
    ];

    protected function casts(): array
    {
        return [
            'fecha_devolucion' => 'datetime',
            'fecha_entrega' => 'dateime'
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function tipoServicio()
    {
        return $this->belongsTo(TipoServicio::class);
    }
}
