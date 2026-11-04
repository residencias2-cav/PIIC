<?php

namespace App\Models\Usuarios;

use App\Models\Oficios\Oficios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    /** @use HasFactory<\Database\Factories\UsuarioFactory> */
    use HasFactory;

    public function destinatarios()
    {
        return $this->belongsToMany(Oficios::class, 'destinatarios', 'usuario_id', 'destinatario_id');
    }

    public function gerencia()
    {
        return $this->belongsTo(\App\Models\Catalogos\Gerencia::class, 'gerencia_id');
    }

    public function areasPermitidas(): array
    {
        $codigoGerencia = $this->gerencia?->code;

        if (!$codigoGerencia) {
            return [];
        }

        return config(
            "areas.{$codigoGerencia}",
            []
        );
    }

    public function puedeAccederArea(string $area): bool
    {
        return array_key_exists($area,$this->areasPermitidas());
    }
}
