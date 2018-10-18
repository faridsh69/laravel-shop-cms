<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddress extends FormRequest
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
	        'display_name' => 'max:190',
	        'phone' => 'required|digits:11',
	        'province' => 'required|numeric|max:40',
	        'city' => 'required|max:190',
            'address' => 'required',
            'sabet_phone' => 'numeric|nullable',
	        'postal_code' => 'numeric|nullable|digits:10',
	        'lable' => 'nullable|max:190',
	        // 'latitude' => 'nullable|numeric',
	        // 'longitude' => 'nullable|numeric',
	    ];
    }
}
