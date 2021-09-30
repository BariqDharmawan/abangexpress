<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmbedMapValidation extends FormRequest
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
            'address_embed' => [
                'required',
                'regex:/^<iframe/',
                'string',
                'min:361'
            ]
        ];
    }

    public function messages()
    {
        return [
            'address_embed.min' => 'address embed looks like invalid',
            'address_embed.regex' => 'address embed should be a valid iframe'
        ];
    }
}
