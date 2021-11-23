<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeRequest extends FormRequest
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
        $rules = [
            'id_income_type' => 'required|exists:income_types,id',
            'total' => 'required|gt:0',
            'ket' => 'nullable'
        ];

        if($this->method() == 'POST'){
            $rules += [
                'date' => 'required',
                'id_customer' => 'required|exists:customers,id',
                'status' => 'required',
            ];
        }

        return $rules;
    }
}
