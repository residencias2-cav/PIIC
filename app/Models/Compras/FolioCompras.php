<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Compras\{
    Pedido,
    Cotizacion
};

class FolioCompras extends Model
{
    /** @use HasFactory<\Database\Factories\FolioComprasFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "folio_compras";

    protected $fillable = [
        'pedido_id',
        'fecha',
        'folio',
        'notas_autorizacion',
        'observaciones'
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime'
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

    public function cotizacion()
    {
        return $this->hasOne(Cotizacion::class);
    }
}
