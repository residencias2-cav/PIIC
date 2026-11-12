<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

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
            'tipo_usuario_id' => ['required', 'integer', 'exists:proveedor,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'usuario.required' => 'Se necesita el usuario para ingresar',
            
            'contraseña.required' => 'Se necesita la contraseña para ingresar',
            
            'proveedor_id.required' => 'No se especifico el proveedor',
            
            'tipo_usuario_id.required' => 'No se especifico el tipo de usuario'
        ]
    }
}
