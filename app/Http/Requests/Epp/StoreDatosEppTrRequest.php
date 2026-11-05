<?php

namespace App\Http\Requests\Epp;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDatosEppTrRequest extends FormRequest
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
            'cantidad' => ['required', 'integer', 'min:1'],
            'descripcion' => ['required', 'string', 'max:100'],
            'codigo' => ['required', 'string', 'max:100'],
            'marca' => ['required', 'string', 'max:100'],
            'color' => ['required', 'string', 'max:100'],
            'medida' => ['required', 'string', 'max:100'],
            'clase' => ['required', 'string', 'max:100'],
            'observaciones' => ['nullable', 'string', 'max:255'],
            'estado_id' => ['required', 'integer', 'exists:estados,id'],
        ];
    }
        
    public function messages(): array
    {
        return [
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los 100 caracteres.',

            'codigo.required' => 'El código es obligatorio.',
            'codigo.string' => 'El código debe ser una cadena de texto.',
            'codigo.max' => 'El código no puede exceder los 100 caracteres.',

            'marca.required' => 'La marca es obligatoria.',
            'marca.string' => 'La marca debe ser una cadena de texto.',
            'marca.max' => 'La marca no puede exceder los 100 caracteres.',

            'color.required' => 'El color es obligatorio.',
            'color.string' => 'El color debe ser una cadena de texto.',
            'color.max' => 'El color no puede exceder los 100 caracteres.',

            'medida.required' => 'La medida es obligatoria.',
            'medida.string' => 'La medida debe ser una cadena de texto.',
            'medida.max' => 'La medida no puede exceder los 100 caracteres.',

            'clase.required' => 'La clase es obligatoria.',
            'clase.string' => 'La clase debe ser una cadena de texto.',
            'clase.max' => 'La clase no puede exceder los 100 caracteres.',
            ];
    }
}
