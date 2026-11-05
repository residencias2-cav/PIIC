<?php

namespace App\Http\Requests\Epp;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDatosEppTrRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'cantidad' => ['sometimes', 'integer', 'min:1'],
            'descripcion' => ['sometimes', 'string', 'max:100'],
            'codigo' => ['sometimes', 'string', 'max:100'],
            'marca' => ['sometimes', 'string', 'max:100'],
            'color' => ['sometimes', 'string', 'max:100'],
            'medida' => ['sometimes', 'string', 'max:100'],
            'clase' => ['sometimes', 'string', 'max:100'],
            'observaciones' => ['sometimes', 'nullable', 'string', 'max:255'],
            'estado_id' => ['sometimes', 'integer', 'exists:estados,id'],
        ];
    }
}
