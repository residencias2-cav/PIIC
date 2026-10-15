<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LugarNacimiento extends Model
{
    /** @use HasFactory<\Database\Factories\LugarNacimientoFactory> */
    use HasFactory;

    protected $table = 'lugar_nacimientos';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class);
    }
}
