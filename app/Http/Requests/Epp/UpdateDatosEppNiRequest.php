<?php

namespace App\Http\Requests;

use App\Enums\sup_int;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDatosEppNiRequest extends FormRequest
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
            'articulo_id' => ['sometimes', 'integer', 'articulos,id'],
            'sup_int' => ['sometimes', Rule::sexo(sup_int::class)],
        ];
    }
}
