<?php

namespace App\Http\Requests\Catalogos;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:50'],
            'rfc' => ['required', 'string', 'max:50'],

            'ciudad' => ['required', 'string', 'max:100'],
            'calle' => ['required', 'string', 'max:255'],
            'cp' => ['required', 'digits:5'],
        ];
    }
}
