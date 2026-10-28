<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Sexo;
use Illuminate\Validation\Rule;

class StoreTrabajadorRequest extends FormRequest
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
            'nt' => ['required', 'string', 'max:20', 'unique:trabajadors,nt'],
            'nombre' => ['required'. 'string', 'max:50'],
            'apellido_paterno' => ['required', 'string', 'max:100'],
            'apellido_materno' => ['required', 'string', 'max:100'],
            'sexo' => ['required', Rule::enum(Sexo::class),],
            'nss' => ['required', 'string', 'max:20', 'unique:trabajadors,nss'],
            'curp'=> ['required', 'string', 'max:18', 'unique:trabajadors,curp'],
            'rfc' => ['required', 'string', 'max:13', 'unique:trabajadors,rfc'],
            'fecha_nacimiento' => ['required', 'date'],
            'lugar_nacimiento_id' => ['required', 'integer', 'exists:lugar_nacimientos,id'],
            'tipo_sangre_id' => ['required', 'integer', 'exists:tipo_sangres,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nt.required' => 'El valor nt es requerido.',
            'nt.unique' => 'Ese nt ya está registrado',
            
            'nombre.required' => 'El campo nombre es requerido.',
            
            'apellido_paterno.required' => 'El campo apellido paterno es requerido.',
            
            'apellido_materno.required' => 'El campo apellido paterno es requerido.',
            
            'sexo.required' => 'El campo sexo es requerido.',
            
            'nss.required' => 'El campo numero del seguro social (NSS) es requerido.',
            
            'curp.required' => 'El campo curp es requerido.',

            'rfc.required' => 'El campo RFC es requerido',
            
            'fecha_nacimiento.required' => 'El campo Fecha de nacimiento es requerido',
            'fecha_nacimiento.date' => 'La fecha no tiene formato valido',

            'lugar_nacimiento_id.required' => 'El campo lugar de nacimiento es requerido',
            'lugar_nacimiento_id.exists' => 'Ese lugar de nacimiento no esta registrado',

            'tipo_sangre_id.required' => 'El campo lugar de nacimiento es requerido',
            'tipo_sangre_id.exists' => 'Vuelva a revisar el tipo de sangre especificado',
            ];
    }

    protected function prepareForValidation()
    {
        return [
            'nss' => $this->folio ? strtoupper(trim($this->nss)): null,
            'curp' => $this->folio ? strtoupper(trim($this->curp)): null,
            'rfc' => $this->folio ? strtoupper(trim($this->rfc)): null,
        ];
    }
}
