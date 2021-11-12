<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLandingCarouselValidation extends FormRequest
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
            'img' => ['required', 'image', 'max:2000']
        ];
    }

    public function messages()
    {
        return [
            'img.max' => 'Gambar tidak boleh lebih dari 2mb',
        ];
    }
}
