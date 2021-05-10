<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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

    public function rules()
    {
        $partner = $this->route()->parameter('partner');
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'identification_type_id' => 'required',
            'identification' => "required|unique:partners,identification,$partner?->id",
            'initial_investment' => 'numeric|min:1',
            'percentage_earn' => 'numeric|max:100',
            'description' => 'required'
        ];


        return $rules;
    }

    public function attributes(){
        return [
            'first_name' => 'nombre',
            'last_name' => 'apellido',
            'identification_type_id' => 'tipo de identificación',
            'identification' => 'identificación',
            'initial_investment' => 'inversión inicial',
            'percentage_earn' => 'porcentage de ganancias',
            'description' => 'dirección'
        ];
    }
}
