<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidad extends Model
{
    /** @use HasFactory<\Database\Factories\UnidadFactory> */
    use HasFactory;

    protected $table = 'unidad'; /** de medida */

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function unidades()
    {
        return $this->hasMany(Pedido::class);
    }
}
