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
                'mimes:png,jpg,jpeg,svg',
                'dimensions:max_width=30,max_height=30'
            ],
            'title' => ['required', 'string', 'max:20', 'min:3'],
            'desc' => ['required', 'string', 'min:5'],
        ];
    }
}
