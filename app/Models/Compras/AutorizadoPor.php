<?php

namespace App\Models\Compras;

use App\Models\Epp\Epp;
use App\Models\Oficios\Mantenimientos;
use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutorizadoPor extends Model
{
    /** @use HasFactory<\Database\Factories\AutorizadoPorFactory> */
    use HasFactory;

    protected $table = 'autorizado_pors';

    protected $fillable = [
        'trabajador_id',
        'epp_id',
        'proceso_autorizado',
        'fecha_autorizacion',
        'observaciones'
    ];

    protected function casts(): array
    {
        return [
            'proceso_autorizado' => 'boolean'
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function epp()
    {
        return $this->belongsTo(Epp::class);
    }

    public function mantenimientos()
    {
        return $this->hasOne(Mantenimientos::class);
    }
}
