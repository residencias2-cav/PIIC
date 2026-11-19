<?php
namespace App\Models\Compras;

use App\Models\Catalogos\{
    Gerencia,
    Proyecto,
    TipoCotizacion,
    EstadoPedido,
    Lugar,
    Obra
};
use App\Models\Proveedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizacions';

    protected $fillable = [
        'pedido_id',
        'fecha',
        'gerencia_id',
        'folio',
        'folio_compra_id',
        'fecha_compras',
        'fecha_solicitud',
        'fecha_requerido',
        'fecha_recibido',
        'proyecto_id',
        'obra_id',
        'lugar_id',
        'tipo_cotizacion_id',
        'notas',
        'estado_pedido_id',
        'created_by'
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'fecha_compras' => 'date',
            'fecha_solicitud' => 'date',
            'fecha_requerido' => 'date',
            'fecha_recibido' => 'date',
            'created_by' => 'integer',
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

    public function gerencia()
    {
        return $this->belongsTo(Gerencia::class);
    }

    public function folioCompras()
    {
        return $this->belongsTo(FolioCompras::class, 'folio_compra_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }

    public function lugar()
    {
        return $this->belongsTo(Lugar::class);
    }

    public function tipoCotizacion()
    {
        return $this->belongsTo(TipoCotizacion::class);
    }

    public function estadoPedido()
    {
        return $this->belongsTo(EstadoPedido::class);
    }

    public function datosCotizacion()
    {
        return $this->hasMany(DatosCotizacion::class);
    }

    public function provContacto()
    {
        return $this->belongsToMany(
            Proveedor::class,
            'prov_contactos',
            'cotizacion_id',
            'proveedor_id'
        )->withTimestamps();
    }
}