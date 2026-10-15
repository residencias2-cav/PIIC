<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obra extends Model
{
    /** @use HasFactory<\Database\Factories\ObraFactory> */
    use HasFactory;

    protected $table = 'obras';

    protected $fillable = [
        'Nombre_Obra',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function obras()
    {
        return $this->hasMany(Cotizacion::class);
    }


}
