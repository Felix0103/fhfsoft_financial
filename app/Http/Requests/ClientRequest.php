<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $client = $this->route()->parameter('client');
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'identification_type_id' => 'required',
            'identification' => "required|unique:clients,identification,$client?->id",
            'credit_limit' => 'numeric|min:100',
        ];


        return $rules;
    }

    public function attributes(){
        return [
            'first_name' => 'nombre',
            'last_name' => 'apellido',
            'identification_type_id' => 'tipo de identificación',
            'identification' => 'identificación',
            'credit_limit' => 'limite de credito',
        ];
    }
}
