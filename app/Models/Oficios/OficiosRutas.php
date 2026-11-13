<?php

namespace App\Models\Oficios;

use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OficiosRutas extends Model
{
    /** @use HasFactory<\Database\Factories\OficiosRutasFactory> */
    use HasFactory;

    protected $table = 'oficios_rutas';
    
    protected $fillable = [
        'oficios_id',
        'folio_ac',
        'ruta',
        'trabajador_id',
        'tipo',
        'carta_porte',
        'factura',
        'no_recoleccion',
        'observaciones'
    ];

    protected function casts(): array
    {
        return [
            'factura' => 'boolean',
            'no_recoleccion' => 'integer'
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function oficios()
    {
        return $this->belongsTo(Oficios::class);
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }
}
