<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpaceRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberValidation extends FormRequest
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
            'avatar_edit' => [
                'sometimes',
                'mimes:png,jpg,jpeg,svg',
                'dimensions:ratio=1/1'
            ],
            'position_id_edit' => ['required', 'integer' ,'exists:position_list,id'],
            'short_desc' => ['required', 'string', 'min:3', 'max:50']
        ];
    }

    public function messages()
    {
        return [
            'avatar_edit.dimensions' => ':attribute should have same width and height'
        ];
    }
}
