<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeHeadingValidation extends FormRequest
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
            'slogan' => ['sometimes', 'string', 'min:3', 'max:100'],
            'our_name' => ['sometimes', 'string', 'min:3', 'max:50'],
        ];
    }
}
