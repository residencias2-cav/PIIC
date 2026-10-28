<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:100'],
            'razon_social' => ['required', 'string', 'max:100'],
            'curp' => ['required', 'string', 'max:18', 'unique:proveedors,curp'],
            'rfc' => ['required', 'string', 'max:13', 'unique:proveedors,rfc'],
            'area' => ['required', 'string', 'max:30'],
            'desc_bs' => ['required', 'string', 'max:100'],
            'vigencia_sat' => ['required', 'date'],
            'inf_credito_id' => ['required', 'int', 'exists:inf_credito,id'],
            'inf_contrato_id' => ['required', 'int', 'exists:inf_contrato,id'],
            'inf_impuestos' => ['required', 'string', 'max:250'],
            'registrado' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El campo nombre es requerido.',

            'razon_social.required' => 'El campo razon social es requerido.',
            
            'curp.required' => 'El campo curp es requerido.',
            'curp.unique' => 'La curp ya está registrada',
            
            'rfc.required' => 'El campo RFC es requerido.',
            'rfc.unique' => 'El RFC ya está registrada',
            
            'area.required' => 'El campo area social es requerido.',
            
            'desc_bs.required' => 'El campo desc_bs es requerido.',
            
            'vigencia_sat.required' => 'El campo vigencia del SAT es requerido.',
            'vigencia_sat.date' => 'La fecha en el campo vigencia del SAT no tiene formato valido.',
            
            'inf_credito_id.required' => 'El campo informacion del credito es requerido.',
            'inf_credito_id.exists' => 'La informacion de credito especificada no existe',
            
            'inf_impuestos.required' => 'El campo informacion de impuestos es requerido.',
            
            'registrado.required' => 'No se especifico si el proveedor está registrado.',
            ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'curp' => $this-> curp ? strtoupper(trim($this->folio)): null,
            'rfc' => $this-> rfc ? strtoupper(trim($this->rfc)): null,
        ]);   
    }
}
