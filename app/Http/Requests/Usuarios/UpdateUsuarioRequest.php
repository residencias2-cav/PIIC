<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'trabajador_id' => ['sometimes', 'integer', 'exists:trabajadores,id'],
            'gerencia_id' => ['sometimes', 'integer', 'exists:gerencias,id'],
            'usuario' => ['sometimes', 'string', 'max:20', 'unique:usuarios,usuario,' . $this->route('usuario')],
            'tipo_usuario_id' => ['sometimes', 'integer', 'exists:tipo_usuarios,id'],
            'tipos_usuario_ch' => ['sometimes', 'boolean'],
            'contrasena' => ['sometimes', 'string', 'max:20'],
            'correo' => ['sometimes', 'string', 'max:50'],
            'contrasena_correo' => ['sometimes', 'string', 'max:20'],
        ];
    }
}
