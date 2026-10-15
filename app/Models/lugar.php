<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lugar extends Model
{
    /** @use HasFactory<\Database\Factories\LugarFactory> */
    use HasFactory;

    protected $table = 'lugars';

    protected $fillable = [
        'nombre_municipio',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function lugares()
    {
        return $this->hasMany(Cotizacion::class);
    }

    
}
