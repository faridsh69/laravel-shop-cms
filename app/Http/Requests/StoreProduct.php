<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
	        // 'price' => 'required|numeric',
	        // 'inventory' => 'required|numeric',
	        // 'discount_price' => 'nullable|numeric',
	        'meta_title' => 'max:190',
	        'meta_description' => 'max:190',
	        'keywords' => 'max:190',
	        'brand_id' => 'nullable|exists:brands,id',
	        'category_id' => 'nullable|exists:categories,id',
	    ];
    }
}
