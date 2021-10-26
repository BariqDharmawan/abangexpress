<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceValidation extends FormRequest
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
            'icon' => [
                'required',
                'unique:App\Models\OurService,icon',
                'string',
                'min:4',
                'starts_with:fa'
            ],
            'title' => [
                'required',
                'unique:App\Models\OurService,title',
                'string',
                'max:20',
                'min:3'
            ],
            'desc' => ['required', 'string', 'min:5'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'icon.min' => 'Please pick a valid :attribute',
            'icon.starts_with' => 'Please pick a valid :attribute starts with "fa"',
        ];
    }

}
