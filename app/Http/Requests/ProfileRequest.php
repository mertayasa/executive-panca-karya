<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $user = $this->route('user');
        $rules = [
            'name' => 'required|string|max:100',
        ];

        if($user->level == 0){
            $rules += ['date' => 'required|before_or_equal:now'];
            $rules += ['gender' => 'required|min:0|max:1'];
            $rules += ['telp' => 'required|numeric|digits_between:10,15'];
            $rules += ['address' => 'required|max:255'];
        }

        if($this->getMethod() == 'PATCH'){
            $rules += ['email' => 'required|email|unique:users,email,'.$user->id];
            if($this->password != null){
                $rules += ['password' => 'required|min:8|confirmed'];
            }
        }

        // dd($rules);

        return $rules;
    }
}
