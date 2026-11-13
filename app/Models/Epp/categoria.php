<?php

namespace App\Models\Epp;

use App\Models\Compras\Pedido;
use App\Models\Oficios\Oficios;
use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'oficios_id',
        'pedido_id',
        'trabajador_id',
        'firma'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function oficio()
    {
        return $this->belongsTo(Oficios::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }
}
