<?php

namespace App\Http\Requests\Epp;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDatosEppReRequest extends FormRequest
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
            'epp_id' => ['required', 'integer', 'exists:epps,id'],
            'fecha_ingreso' => ['required', 'date'],
            'motivo' => ['required', 'string', 'max:100'],
            'articulo_id' => ['required', 'integer', 'exists:articulos,id'],
            'fecha_entrega' => ['required', 'date'],
            'foto_evidencia' => ['required', 'string', 'max:50'],
            'observaciones' => ['required', 'string', 'max:100'],
            'talla' => ['required', 'integer'],
            'estado_id' => ['required', 'integer', 'exists:estados,id'],
            'fecha_estado' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'trabajador_id.required' => 'El campo trabajador es obligatorio.',
            'trabajador_id.exists' => 'El trabajador seleccionado no existe.',

            'epp_id.required' => 'El campo EPP es obligatorio.',
            'epp_id.exists' => 'El EPP seleccionado no existe.',

            'fecha_ingreso.required' => 'El campo fecha de ingreso es obligatorio.',

            'motivo.required' => 'El campo motivo es obligatorio.',

            'articulo_id.required' => 'El campo artículo es obligatorio.',
            'articulo_id.exists' => 'El artículo seleccionado no existe.',
            
            'fecha_entrega.required' => 'El campo fecha de entrega es obligatorio.',

            'foto_evidencia.required' => 'El campo foto de evidencia es obligatorio.',

            'observaciones.required' => 'El campo observaciones es obligatorio.',

            'talla.required' => 'El campo talla es obligatorio.',

            'estado_id.required' => 'El campo estado es obligatorio.',
            'estado_id.exists' => 'El estado seleccionado no existe.',
            
            'fecha_estado.required' => 'El campo fecha de estado es obligatorio.',
        ];
    }
}
