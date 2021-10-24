<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertRequest extends FormRequest
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
            'title' => 'required|filled|unique:adverts|string|max:128',
            'description' => 'required|max:512',
            'price' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5220',
            'video' => 'nullable|mimetypes:video/mpeg,video/mp4',
            'phone_num' => 'required|max:20',
            'package_id' => 'string',
            'selected' => 'string'
        ];
    }
}
