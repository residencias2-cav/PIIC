<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Articulo extends Model
{
    /** @use HasFactory<\Database\Factories\ArticuloFactory> */
    use HasFactory;

    protected $table = 'articulos';

    protected $fillable = [
        "nombre",
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function inventariosEpp()
    {
        return $this->hasMany(InventarioEpp::class);
    }

    public function datosEppRc()
    {
        return $this->hasMany(DatosEppRc::class);
    }

    public function datosEppNi()
    {
        return $this->hasMany(DatosEppNi::class);
    }

    Public function datosEppRe()
    {
        return $this->hasMany(DatosEppRe::class);
    }
}
