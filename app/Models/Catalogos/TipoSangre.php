<?php

namespace App\Models;

use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoSangre extends Model
{
    /** @use HasFactory<\Database\Factories\TipoSangreFactory> */
    use HasFactory;

    protected $table = 'tipo_sangres';

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
