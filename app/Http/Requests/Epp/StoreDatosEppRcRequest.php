<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDatosEppRcRequest extends FormRequest
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
            'epp_id' => ['required', 'integer', 'exists.epps,id'],
            'trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'articulo_id' => ['required', 'integer', 'exists:articulos,id'],
            'talla' => ['required', 'string', 'max:50'],
        ];
    }

    public function messages()
    {
        return [
            'trabajador_id.required' => 'Debe seleccionar un trabajador',
            'trabajador_id.exists' => 'El trabajador seleccionado no existe',

            'articulo_id.required' => 'Debe seleccionar un articulo',

            'talla.required' => 'Debe especificar una talla',
        ];
    }
}
