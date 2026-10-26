<?php

namespace App\Models\Catalogos;

use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarNacimiento extends Model
{
    /** @use HasFactory<\Database\Factories\LugarNacimientoFactory> */
    use HasFactory;

    protected $table = 'lugar_nacimientos';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function lugaresNacimiento()
    {
        return $this->hasMany(Trabajador::class);
    }

    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class);
    }
}
