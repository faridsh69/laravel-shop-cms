<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegister extends FormRequest
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
        return [
	        'first_name' => 'required|max:190',
	        'last_name' => 'required|max:190',
	        'password' => 'required|max:190',
	        // 'phone' => 'required|numeric|digits:11|unique:users',
	        'phone' => 'required|numeric|unique:users',
	    ];
    }
}
