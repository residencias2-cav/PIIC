<?php

namespace App\Http\Requests;

use App\Enums\sup_int;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreDatosEppNiRequest extends FormRequest
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
            'epp_id' => ['required', 'integer', 'exists:epps, id'],
            'trabajador_id' => ['required', 'integer', 'exists:trabajadores, id'],
            'articulo_id' => ['required', 'integer', 'exists:articulos, id'],
            'sup_int' => ['required', 'boolean'],
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'trabajador_id.required' => 'Debe seleccionar un trabajador.',
            'trabajador_id.exists' => 'El trabajador seleccionado no existe.',
            
            'articulo_id.required' => 'Debe seleccionar un articulo.',
            
            'sup_int.required' => 'Debe seleccionar un area.',
            ];
    }
}
