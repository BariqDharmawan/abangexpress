<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpaceRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberValidation extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:60', new AlphaSpaceRule],
            'avatar' => ['sometimes', 'image', 'max:2000'],
            'position' => ['required', 'string', 'max:15'],
            'short_desc' => ['required', 'string', 'min:8', 'max:50']
        ];
    }

}
