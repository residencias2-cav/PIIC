<?php
namespace App\Models\Catalogos;

use App\Models\Compras\PedidoInterno;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    use HasFactory;

    protected $table = 'tipo_servicios';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function pedidosInternos()
    {
        return $this->hasMany(
            PedidoInterno::class,
            'tipo_servicio_id'
        );
    }
}