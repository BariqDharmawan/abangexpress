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
            'icon' => [
                'required',
                'max:1000',
                'mimes:png,jpg,jpeg,svg',
                'dimensions:max_width=30,max_height=30'
            ],
            'platform' => [
                'required',
                'unique:our_socials,platform',
                'in:' . implode(',', Helper::getListSocialPlatform())
            ],
            'username' => ['required', 'string', 'min:3', 'max:40']
        ];
    }
}
