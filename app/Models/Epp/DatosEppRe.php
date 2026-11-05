<?php

namespace App\Models\Epp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Trabajador;
use App\Models\Epp\Epp;

class DatosEppRe extends Model
{
    /** @use HasFactory<\Database\Factories\DatosEppReFactory> */
    use HasFactory;

    protected $table = "datos_epp_res";

    protected $fillable = [
        'trabajador_id',
        'epp_id',
        'fecha_ingreso',
        'motivo',
        'articulo_id',
        'fecha_entrega',
        'foto_evidencia',
        'observaciones',
        'talla',
        'estado_id',
        'fecha_estado'
    ];

    protected function casts(): array
    {
        return [
            'trabajador_id' => 'integer',
            'epp_id' => 'integer',
            'fecha_ingreso' => 'date',
            'motivo' => 'string',
            'articulo_id' => 'integer',
            'fecha_entrega' => 'date',
            'foto_evidencia' => 'string',
            'observaciones' => 'string',
            'talla' => 'integer',
            'estado_id' => 'integer',
            'fecha_estado' => 'date'
        ];
    }

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function epp()
    {
        return $this->belongsTo(Epp::class);
    }
}
