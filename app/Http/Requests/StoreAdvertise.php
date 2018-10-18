<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertise extends FormRequest
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
	        'title' => 'required|max:190',
	        // 'price' => 'nullable|numeric',
	        // 'phone' => 'numeric',
	        // 'brand_id' => 'nullable|exists:brands,id',
	        // 'category_id' => 'nullable|exists:categories,id',
	        // 'aggrement' => 'required',
	    ];
    }
}
