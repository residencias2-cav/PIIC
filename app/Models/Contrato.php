<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contrato extends Model
{
    /** @use HasFactory<\Database\Factories\ContratoFactory> */
    use HasFactory;

<<<<<<< HEAD
    protected $table = 'contrato';
=======
    protected $table = 'contratos';
>>>>>>> 6d823ea603ef9e201874aed258c3412ff9fa991c

    protected $fillable = [
        "nombre",
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
<<<<<<< HEAD
=======

    public function oficiosProducto()
    {
        return $this->hasMany(OficiosProducto::class);
    }

    public function oficiosRepSe()
    {
        return $this->hasMany(OficiosRepSe::class);
    }
>>>>>>> 6d823ea603ef9e201874aed258c3412ff9fa991c
}
