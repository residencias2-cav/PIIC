<?php

namespace App\Models\Catalogos;

use App\Models\Epp\{
    DatosEppTr,
    DatosEppRe
    };
use App\Models\Oficios\Oficios;
use App\Models\Compras\Pedido;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
    /** @use HasFactory<\Database\Factories\EstadoFactory> */
    use HasFactory;

    protected $table = 'estados';

    protected $fillable = [
        'nombre_estado',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function oficios()
    {
        return $this->hasMany(Oficios::class);
    }

    public function datosEppRe()
    {
        return $this->hasMany(DatosEppRe::class);
    }

    public function datosEppTr()
    {
        return $this->hasMany(DatosEppTr::class);
    }
}
