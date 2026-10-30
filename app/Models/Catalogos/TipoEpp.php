<?php

namespace App\Models\Catalogos;

use App\Models\Epp\Epp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoEpp extends Model
{
    /** @use HasFactory<\Database\Factories\TipoEppFactory> */
    use HasFactory;

    protected $table = 'tipo_epps';

    protected $fillable = [
        'nombre'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function epp()
    {
        return $this->hasMany(Epp::class);
    }
}
