<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'name' => 'required|string|max:100',
            'date' => 'required|before_or_equal:now',
            'gender' => 'required|min:0|max:1',
            'telp' => 'required|numeric|digits_between:10,15',
            'address' => 'required|max:255',
        ];

        if($this->getMethod() == 'POST'){
            $rules += ['email' => 'required|email|unique:users,email'];
            $rules += ['password' => 'required|min:8'];
        }

        if($this->getMethod() == 'PATCH'){
            $rules += ['email' => 'required|email|unique:users,email,'.$this->user_id];
            if($this->password != null){
                $rules += ['password' => 'required|min:8'];
            }
        }

        return $rules;
    }
}
