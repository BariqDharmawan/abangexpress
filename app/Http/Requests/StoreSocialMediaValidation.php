<?php

namespace App\Http\Requests;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class StoreSocialMediaValidation extends FormRequest
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
            'icon' => ['required', 'string', 'starts_with:fa', 'min:4'],
            'platform' => [
                'required',
                'unique:our_socials,platform',
                'in:' . implode(',', Helper::getListSocialPlatform())
            ],
            'username' => ['required', 'string', 'min:3', 'max:40']
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
