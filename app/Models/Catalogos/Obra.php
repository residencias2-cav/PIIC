<?php

namespace App\Models\Catalogos;

use App\Models\Compras\Cotizacion;
use App\Models\Epp\Epp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obra extends Model
{
    /** @use HasFactory<\Database\Factories\ObraFactory> */
    use HasFactory;

    protected $table = 'obras';

    protected $fillable = [
        'nombre_obra',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class);
    }

    public function epp()
    {
        return $this->hasMany(Epp::class);
    }
}
