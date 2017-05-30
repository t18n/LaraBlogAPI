<?php

namespace App\Http\Requests;

class UpdatePostRequest extends FormRequestExtended
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
        'title' => 'min:3|max:100|unique:posts',
        'content' => 'min:100',
        'created_date' => 'date_format:Y-m-d H:i:s',
        'slug' => 'unique:posts'
        ];
    }
}
