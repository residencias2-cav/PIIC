<?php

namespace App\Models\Oficios;

use App\Models\Catalogos\Gerencia;
use App\Models\Compras\AutorizadoPor;
use App\Models\Compras\Pedido;
use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimientos extends Model
{
    /** @use HasFactory<\Database\Factories\MantenimientosFactory> */
    use HasFactory;

    protected $table = 'mantenimientos';

    protected $fillable = [
        'pedido_id',
        'fecha',
        'trabajador_id',
        'gerencia_id',
        'folio',
        'lugar',
        'descripcion',
        'material_necesario',
        'autorizado_por_id',
        'surtido'
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
            'folio' => 'integer',
            'surtido' => 'boolean'
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

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function gerencia()
    {
        return $this->belongsTo(Gerencia::class);
    }

    public function autorizadoPor()
    {
        return $this->belongsTo(AutorizadoPor::class);
    }
}
