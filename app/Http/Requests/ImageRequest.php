<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'the image is required',
            'image.mimes' => 'the image must be a file of type: jpeg,png,jpg,gif,svg',
            'image.max' => 'La imagen debe ser menor a 20MB',
        ];
    }
}
