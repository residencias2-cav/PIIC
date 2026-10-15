<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contrato extends Model
{
    /** @use HasFactory<\Database\Factories\ContratoFactory> */
    use HasFactory;

    protected $table = 'contratos';

    protected $fillable = [
        "nombre",
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function oficiosProducto()
    {
        return $this->hasMany(OficiosProducto::class);
    }

    public function oficiosRepSe()
    {
        return $this->hasMany(OficiosRepSe::class);
    }
}
