<?php

namespace App\Models\Epp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catalogos\Estado;
use App\Models\Epp\Epp;

class DatosEppTr extends Model
{
    /** @use HasFactory<\Database\Factories\DatosEppTrFactory> */
    use HasFactory;

    protected $table = 'datos_epp_trs';

    protected $fillable = [
        'epp_id',
        'cantidad',
        'descripcion',
        'codigo',
        'marca',
        'color',
        'medida',
        'clase',
        'observaciones',
        'estado_id',
        'fecha_estado',
    ];

    protected $casts = [
        'fecha_estado' => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function epp()
    {
        return $this->belongsTo(Epp::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
