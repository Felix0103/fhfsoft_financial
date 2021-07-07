<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionTypeRequest extends FormRequest
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
        $transactiontype = $this->route()->parameter('transactiontype');
        $rules = [
            'description' => "required|unique:accounts,description,$transactiontype?->id",
            'type' => 'required'
        ];
        return $rules;
    }
    public function attributes(){
        return [

            'description' => 'Nombre del type de transaction',
            'type' => 'Tipo de transaction'
        ];
    }
}
