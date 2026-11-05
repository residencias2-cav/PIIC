<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
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
            'trabajador_id' => ['required', 'integer', 'exists:trabajadores,id'],
            'gerencia_id' => ['required', 'integer', 'exists:gerencias,id'],
            'usuario' => ['required', 'string', 'max:20', 'unique:usuarios,usuario'],
            'tipo_usuario_id' => ['required', 'integer', 'exists:tipo_usuarios,id'],
            'tipos_usuario_ch' => ['required', 'boolean'],
            'contrasena' => ['required', 'string', 'max:20'],
            'correo' => ['required', 'string', 'max:50'],
            'contrasena_correo' => ['required', 'string', 'max:20'],
            'twofa_code' => ['required', 'string', 'max:32'],
            'twofa_expire' => ['required', 'date'],
            'twofa_attempts' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'trabajador_id.required' => 'Debe seleccionar un trabajador.',
            'trabajador_id.exists' => 'El trabajador seleccionado no existe.',

            'gerencia_id.required' => 'Debe seleccionar una gerencia.',
            'gerencia_id.exists' => 'La gerencia seleccionada no existe.',

            'usuario.required' => 'El usuario es obligatorio.',
            'usuario.unique' => 'Ya existe este usuario.',
            'contrasena.required' => 'La contraseña es obligatoria.',

            'tipo_usuario_id.required' => 'Debe seleccionar un tipo de usuario.',
            'tipo_usuario_id.exists' => 'El tipo de usuario seleccionado no existe.',

            'tipos_usuario_ch.required' => 'Debe seleccionar un tipo de usuario.',
            'tipos_usuario_ch.boolean' => 'El valor del tipo de usuario debe ser verdadero o falso.',

            'correo.required' => 'El correo es obligatorio.',
            'contrasena_correo.required' => 'La contraseña del correo es obligatoria.',

            'twofa_code.required' => 'El código 2FA es obligatorio.',
            'twofa_attempts.required' => 'El número de intentos del 2FA es obligatorio.',
        ];
    }
}
