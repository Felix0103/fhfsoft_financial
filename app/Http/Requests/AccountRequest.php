<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
        $account = $this->route()->parameter('account');
        $rules = [
            'description' => "required|unique:accounts,description,$account?->id",
            'code' => "required|unique:accounts,code,$account?->code"
        ];
        return $rules;
    }
    public function attributes(){
        return [

            'description' => 'Nombre de la cuenta',
            'code' => 'Codigo de la cuenta'
        ];
    }
}
