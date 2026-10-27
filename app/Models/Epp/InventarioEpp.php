<?php

namespace App\Models\Epp;

use App\Models\Catalogos\Articulo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioEpp extends Model
{
    /** @use HasFactory<\Database\Factories\InventarioEppFactory> */
    use HasFactory;

    protected $table = 'inventario_epps';

    protected $fillable = [
        'articulo_id',
        'talla',
        'existencia',
    ];

    function casts()
    {
        return [
            'talla' => 'date',
            'existencia' => 'date',
        ];
    }

    protected $hidden = [
        'updated_at',
        'created at',
    ];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
