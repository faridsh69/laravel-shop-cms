<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentPage extends FormRequest
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
	        'content' => 'required',
	        'meta_title' => 'max:190',
	        'meta_description' => 'max:190',
	        'category_id' => 'nullable|exists:categories,id',
	    ];
    }
}
