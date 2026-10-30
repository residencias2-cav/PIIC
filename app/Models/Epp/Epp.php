<?php

namespace App\Models\Epp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catalogos\{
    Obra,
    TipoEpp,
    Empresa
    };
use App\Models\Compras\AutorizadoPor;
use App\Models\Epp\{
    DatosEppEx,
    DatosEppNi,
    DatosEppRc,
    DatosEppTr,
    DatosEppRe
    };
use Illuminate\Database\Eloquent\SoftDeletes;

class Epp extends Model
{
    /** @use HasFactory<\Database\Factories\EppFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "epps";

    protected $fillable = [
        'fecha',
        'folio',
        'tipo_epp_id',
        'obra_id',
        'empresa_id',
        'motivo',
        'justificacion',
        'logistica',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'created_by' => 'integer',
        ];    
    }

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    public function tipoEpp()
    {
        return $this->belongsTo(TipoEpp::class);
    }
    
    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }
    
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function datosEppEx()
    {
        return $this->hasMany(DatosEppEx::class);
    }

    public function datosEppNi()
    {
        return $this->hasMany(DatosEppNi::class);
    }

    public function datosEppRc()
    {
        return $this->hasMany(DatosEppRc::class);
    }

    public function datosEppTr()
    {
        return $this->hasMany(DatosEppTr::class);
    }

    public function datosEppRe()
    {
        return $this->hasMany(DatosEppRe::class);
    }

    public function autorizadoPor()
    {
        return $this->hasOne(AutorizadoPor::class);
    }
}