<?php

namespace App\Models\Compras;

use App\Models\Catalogos\{
    Empresa,
    Estado,
    Gerencia,
    Proyecto,
    TipoCompra,
    TipoPedido, 
    Ubicacion};
use App\Models\Oficios\Mantenimientos;
use App\Models\Compras\{
    FolioCompras,
    DetallePedido,
    PedidoInterno,
    Autorizacion,
    Cotizacion};
use App\Models\Epp\Categoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'pedidos';

    protected $fillable = [
        'fecha',
        'folio',
        'tipo_pedido_id',
        'gerencia_id',
        'empresa_id',
        'proyecto_id',
        'ubicacion_id',
        'tipo_compra_id',
        'estado_id',
        'observaciones',
        'monto_credito',
        'monto',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'monto_credito' => 'integer',
            'created_by' => 'integer',
        ];
    }

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function tipoPedido()
    {
        return $this->belongsTo(TipoPedido::class);
    }

    public function gerencia()
    {
        return $this->belongsTo(Gerencia::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function tipoCompra()
    {
        return $this->belongsTo(TipoCompra::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimientos::class);
    }

    public function folioCompras()
    {
        return $this->hasOne(FolioCompras::class);
    }

    public function detallesPedido()
    {
        return $this->hasMany(DetallePedido::class);
    }

    public function pedidosInternos()
    {
        return $this->hasMany(PedidoInterno::class);
    }

    public function autorizacion()
    {
        return $this->hasOne(Autorizacion::class);
    }

    public function cotizacion()
    {
        return $this->hasOne(Cotizacion::class);
    }

    public function Categoria()
    {
        return $this->hasOne(Categoria::class);
    }
}
