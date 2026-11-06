<?php

namespace App\Models\Epp;

use App\Models\Catalogos\Articulo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Epp\Epp;
use App\Models\Usuarios\Trabajador;

class DatosEppNi extends Model
{
    /** @use HasFactory<\Database\Factories\DatosEppNiFactory> */
    use HasFactory;

    protected $table = 'datos_epp_nis';

    protected $fillable = [
        'epp_id',
        'trabajador_id',
        'articulo_id',
        'sup_int',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
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
