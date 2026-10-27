<?php

namespace App\Models\Oficios;

use App\Models\Catalogos\{
    Estado,
    TipoOficio,};
use App\Models\Epp\Categoria;
use App\Models\Oficios\{
    OficiosProductos,
    OficiosRepse,
    OficiosComisiones,
    };
use App\Models\Usuarios\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficios extends Model
{
    /** @use HasFactory<\Database\Factories\OficiosFactory> */
    use HasFactory;

    protected $table = 'oficios';

    protected $fillable = [
        'folio',
        'fecha',
        'asunto',
        'cuerpo',
        'tipo_oficio_id',
        'estado_id',
        'observaciones',
        'cargos_generales',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function tipoOficio()
    {
        return $this->belongsTo(TipoOficio::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function oficiosProducto()
    {
        return $this->hasMany(OficiosProductos::class);
    }

    public function oficiosRepSe()
    {
        return $this->hasMany(OficiosRepse::class);
    }

    public function oficiosRutas()
    {
        return $this->hasMany(OficiosRutas::class);
    }

    public function oficiosComisiones()
    {
        return $this->hasMany(OficiosComisiones::class);
    }

    public function categoria()
    {
        return $this->hasOne(Categoria::class);
    }

    public function destinatarios()
    {
        return $this->belongsToMany(Usuario::class, 'destinatarios', 'oficio_id', 'usuario_id');
    }
}
