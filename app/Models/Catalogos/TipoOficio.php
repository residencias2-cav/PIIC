<?php

namespace App\Models;

use App\Models\Oficios\Oficios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoOficio extends Model
{
    /** @use HasFactory<\Database\Factories\TipoOficioFactory> */
    use HasFactory;

    protected $table = 'tipo_oficios';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
    public function oficios()
    {
        return $this->hasMany(Oficios::class);
    }
}
