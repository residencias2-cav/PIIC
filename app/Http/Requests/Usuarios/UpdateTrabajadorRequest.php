<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Sexo;
use Illuminate\Validation\Rule;
use App\Models\Usuarios\Trabajador;

class UpdateTrabajadorRequest extends FormRequest
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
            'nt' => [
                'sometimes',
                'string',
                'max:15',
                Rule::unique(Trabajador::class, 'nt')->ignore($this->route('trabajador')),
            ],
            'nombre' => ['sometimes', 'string', 'max:50'],
            'apellido_paterno' => ['sometimes', 'string', 'max:100'],
            'apellido_materno' => ['sometimes', 'string', 'max:100'],
            'sexo' => ['sometimes', Rule::enum(Sexo::class),],
            'nss' => [
                'sometimes',
                'string',
                'max:20',
                Rule::unique(Trabajador::class, 'nss')->ignore($this->route('trabajador')),
            ],
            'curp' => [
                'sometimes',
                'string',
                'max:18',
                Rule::unique(Trabajador::class, 'curp')->ignore($this->route('trabajador')),
            ],
            'rfc' => [
                'sometimes',
                'string',
                'max:13',
                Rule::unique(Trabajador::class, 'rfc')->ignore($this->route('trabajador')),
            ],
            'fecha_nacimiento' => ['sometimes', 'date'],
            'lugar_nacimiento_id' => ['sometimes', 'integer', 'exists:lugar_nacimientos,id'],
            'tipo_sangre_id' => ['sometimes', 'integer', 'exists:tipo_sangres,id']
        ];
    }
}
