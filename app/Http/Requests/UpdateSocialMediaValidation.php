<?php

namespace App\Http\Requests;

use App\Helper\Helper;
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
            'icon' => ['required', 'mimetypes:image/png,image/jpeg,image/svg'],
            'platform' => ['required', Rule::in(Helper::getListSocialPlatform())],
            'username' => ['required', 'string', 'min:4', 'max:40']
        ];
    }
}
