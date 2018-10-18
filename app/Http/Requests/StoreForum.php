<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreForum extends FormRequest
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
	        'title' => 'max:190',
	        'content' => 'required',
	        'forum_id' => 'nullable|exists:forums,id',
	        'category_id' => 'nullable|exists:categories,id',
	    ];
    }
}
