<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenu extends FormRequest
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
	        'location' => 'required|max:2|min:1',
	        'url' => 'max:190',
	        'status' => 'required|min:1|max:2',
	        'meta_description' => 'max:190',
	        'menu_item_id' => 'nullable|exists:menus,id',
	    ];
    }
}
