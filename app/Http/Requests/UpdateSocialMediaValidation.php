<?php

namespace App\Http\Requests;

use App\Helper\Helper;
use App\Models\OurSocial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class UpdateSocialMediaValidation extends FormRequest
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
                'sometimes',
                'max:1000',
                'mimes:png,jpg,jpeg,svg',
                'dimensions:max_width=30,max_height=30'
            ],
            'platform' => ['required', 'in:' . implode(',', Helper::getListSocialPlatform())],
            'username' => ['required', 'string', 'min:4', 'max:40']
        ];
    }

    public function messages()
    {
        return [
            'icon.max' => 'Max :attribute is 1mb',
            'icon.dimensions' => ':attribute should be have max 30x30 pixel'
        ];
    }

}
