<?php

namespace App\Models\Catalogos;

use App\Models\Compras\Pedido;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ubicacion extends Model
{
    /** @use HasFactory<\Database\Factories\UbicacionFactory> */
    use HasFactory;

    protected $table = 'ubicacions';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function ubicaciones()
    {
        return $this->hasMany(Pedido::class);
    }
}
