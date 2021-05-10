<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $collector = $this->route()->parameter('collector');
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'identification_type_id' => 'required',
            'identification' => "required|unique:clients,identification,$collector?->id",
        ];

        return $rules;
    }

    public function attributes(){
        return [
            'first_name' => 'nombre',
            'last_name' => 'apellido',
            'identification_type_id' => 'tipo de identificación',
            'identification' => 'identificación',
        ];
    }
}
