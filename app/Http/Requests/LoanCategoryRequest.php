<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanCategoryRequest extends FormRequest
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
     * loanCategory
     */
    public function rules()
    {
        $loanCategory = $this->route()->parameter('loancategory');


        $rules = [
            'description' => "required|unique:loan_categories,description,$loanCategory?->id",
            'loan_type_id' => 'required',
            'duration' => 'required|numeric',
            'billing_cycle_id' => 'required',
            'period_rate' => 'required|numeric',
        ];
        return $rules;
    }
    public function attributes(){
        return [

            'description' => 'Nombre del tipo de prestamo',
            'loan_type_id' => 'Categoria del prestamo',
            'duration' => 'Duración por default',
            'billing_cycle_id' => 'Periodo de facturación',
            'period_rate' => 'Tasa por default',
        ];




    }
}
