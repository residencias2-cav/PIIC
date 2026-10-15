<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoEpp extends Model
{
    /** @use HasFactory<\Database\Factories\TipoEppFactory> */
    use HasFactory;

    protected $table = 'tipo_epps';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function epps()
    {
        return $this->hasMany(Epp::class);
    }
}
