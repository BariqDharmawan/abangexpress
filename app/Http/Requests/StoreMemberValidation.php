<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpaceRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberValidation extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:150', new AlphaSpaceRule],
            'avatar' => [
                'required',
                'mimes:png,jpg,jpeg,svg',
                'dimensions:min_width=90,min_height=90'
            ],
            'position_id' => ['required', 'integer' ,'exists:position_list,id'],
            'short_desc' => ['required', 'string', 'min:3', 'max:50']
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
            'avatar.dimensions' => ':attribute should have size max 180x180',
        ];
    }
}
