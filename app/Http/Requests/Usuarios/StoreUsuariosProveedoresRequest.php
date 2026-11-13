<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUsuariosProveedoresRequest extends FormRequest
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
            'usuario' => ['required', 'string', 'max:80'],
            'contraseña' => ['required', 'string', 'max:20'],
            'proveedor_id' => ['required', 'integer', 'exists:proveedor,id'],
            'tipo_usuario_id' => ['required', 'integer', 'exists:tipo_usuarios,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'usuario.required' => 'No se especificó el usuario',
            
            'contraseña.required' => 'No se especificó la contraseña',
            
            'proveedor_id.required' => 'No se especificó el proveedor',
            
            'tipo_usuario_id.required' => 'No se especificó el tipo de usuario'
        ];
    }
}
