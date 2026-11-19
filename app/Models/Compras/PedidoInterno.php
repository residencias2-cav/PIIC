<?php
namespace App\Models\Compras;

use App\Models\Catalogos\TipoServicio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoInterno extends Model
{
    use HasFactory;

    protected $table = 'pedido_internos';

    protected $fillable = [
        'pedido_id',
        'tipo_servicio_id',
        'descripcion',
        'fecha_devolucion',
        'fecha_entrega',
    ];

    protected function casts(): array
    {
        return [
            'fecha_devolucion' => 'date',
            'fecha_entrega' => 'date',
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function tipoServicio()
    {
        return $this->belongsTo(
            TipoServicio::class,
            'tipo_servicio_id'
        );
    }
}