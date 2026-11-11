<?php

namespace App\Models\Epp;

use App\Models\Catalogos\Estado;
use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

class DatosEppEx extends Model
{
    /** @use HasFactory<\Database\Factories\DatosEppExFactory> */
    use HasFactory;

    protected $table = 'datos_epp_exes';

    protected $fillable = [
        'epp_id',
        'trabajador_id',
        'cantidad',
        'equipo',
        'codigo',
        'marca',
        'contrato',
        'observaciones',
        'precio',
        'adjuntos',
        'estado_id',
        'fecha_estado'
    ];

    protected function casts(): array
    {
        return [
            'cantidad' => 'integer',
            'contrato' => 'boolean',
            'precio' => 'decimal',
            'fecha_estado' => 'date'
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function epp()
    {
        $this->belongsTo(Epp::class);
    }

    public function trabajador()
    {
        $this->belongsTo(Trabajador::class);
    }

    public function estado()
    {
        $this->belongsTo(Estado::class);
    }
}
