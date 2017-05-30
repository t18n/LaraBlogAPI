<?php

namespace App\Http\Requests;

class UpdateSubCategoryRequest extends FormRequestExtended
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
        'name' => 'min:2 | max:40 | unique:sub_categories',
        'category_id' => 'exists:category,id'
        ];
    }
}
