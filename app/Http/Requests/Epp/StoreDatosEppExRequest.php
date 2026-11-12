<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDatosEppExRequest extends FormRequest
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
            'epp_id' => ['required', 'integer', 'exists:epps,id'],
            'trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'cantidad' => ['required', 'integer'],
            'equipo' => ['required', 'string', 'max:50'],
            'codigo' => ['required', 'string', 'max:50'],
            'marca' => ['required', 'string', 'max:50'],
            'contrato' => ['required', 'boolean'],
            'observaciones' => ['string', 'max:100'],
            'precio' => ['required', 'numeric', 'decimal:2'],
            'adjuntos' => ['string', 'max:50'],
            'estado_id' => ['required', 'integer', 'exists:estados,id'],
            'fecha_estado' => ['required', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'trabajador_id.required' => 'Debe especificar un trabajador',
            'trabajador_id.exists' => 'El trabajador seleccionado no existe',
            
            'Cantidad.required' => 'Debe especificar una cantidad',
            
            'equipo.required' => 'Debe especificar el equipo',
            
            'codigo.required' => 'Debe especificar el codigo',
            
            'marca.required' => 'Debe especificar el marca',
            
            'precio.required' => 'Debe especificar el precio',
            ];
    }
}
