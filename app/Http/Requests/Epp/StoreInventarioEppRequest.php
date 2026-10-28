<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioEppRequest extends FormRequest
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
            'articulo_id' => ['required', 'integer', 'exists:articulo, id'],
            'talla' => ['required', 'integer'],
            'existencia' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'articulo_id.required' => 'Debe seleccionar un articulo.',
            'articulo_id.exists' => 'El articulo no existe.',

            'talla.required' => 'Debe especificar la talla del articulo',
            'talla.integer' => 'El valor debe ser numerico',

            'existencia.required' => 'Se debe especificar la cantidad de existencias',
            'existencia.integer' => 'El valor debe ser numerico',
        ];
    }
}
