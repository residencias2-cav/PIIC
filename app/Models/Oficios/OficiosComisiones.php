<?php

namespace App\Models\Oficios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OficiosComisiones extends Model
{
    /** @use HasFactory<\Database\Factories\OficiosComisionesFactory> */
    use HasFactory;

    protected $table = 'oficios_comisiones';

    protected $fillable = [
        'oficios_id',
        'dias',
        'comision',
        'ciudad_destino',
        'fecha_hora_inicio',
        'fecha_hora_termino'
    ];

    protected function casts(): array
    {
        return [
            'dias' => 'integer',
            'fecha_hora_inicio' => 'datetime',
            'fecha_hora_termino' => 'datetime'
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function oficio()
    {
        return $this->belongsTo(Oficios::class);
    }
}
