<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Sexo;
use App\Models\Catalogos\{
    TipoSangre,
    LugarNacimiento
    };
use App\Models\Compras\AutorizadoPor;
use App\Models\Epp\{
    Categoria,
    DatosEppEx,
    DatosEppNi,
    DatosEppRe,
    DatosEppRc,
};
use App\Models\Oficios\{
    Mantenimientos,
    OficiosRutas};
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Usuarios\Usuario;

class Trabajador extends Model
{
    /** @use HasFactory<\Database\Factories\TrabajadorFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'trabajadors';

    protected $fillable = [
        'nt',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'nss',
        'curp',
        'rfc',
        'fecha_nacimiento',
        'lugar_nacimiento_id',
        'tipo_sangre_id',
    ];

    protected function casts(): array
    {
        return [
            'sexo' => Sexo::class,
            'fecha_nacimiento' => 'date',
        ];
    }

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function lugarNacimiento()
    {
        return $this->belongsTo(LugarNacimiento::class);
    }

    public function tipoSangre()
    {
        return $this->belongsTo(TipoSangre::class);
    }
    
    public function ususario()
    {
        return $this->hasOne(Usuario::class);
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimientos::class);
    }

    public function autorizadoPor()
    {
        return $this->hasMany(AutorizadoPor::class);
    }

    public function datpsEppEx()
    {
        return $this->hasMany(DatosEppEx::class);
    }
    
    public function datpsEppNi()
    {
        return $this->hasMany(DatosEppNi::class);
    }

    public function datosEppRe()
    {
        return $this->hasMany(DatosEppRe::class);
    }
    
    public function datosEppRc()
    {
        return $this->hasMany(DatosEppRc::class);
    }

    public function oficiosRutas()
    {
        return $this->hasMany(OficiosRutas::class);
    }

    public function categoria()
    {
        return $this->hasMany(Categoria::class);
    }

    
}