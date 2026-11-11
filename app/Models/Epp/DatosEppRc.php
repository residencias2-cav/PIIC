<?php

namespace App\Models\Epp;

use App\Models\Catalogos\Articulo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Epp\Epp;
use App\Models\Usuarios\Trabajador;

class DatosEppRc extends Model
{
    /** @use HasFactory<\Database\Factories\DatosEppRcFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'datos_epp_rcs';

    protected $fillable = [
        'epp_id',
        'trabajador_id',
        'articulo_id',
        'talla',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function epp()
    {
        return $this->belongsTo(Epp::class);
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
