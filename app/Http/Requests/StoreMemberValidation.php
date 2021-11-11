<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpaceRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'avatar' => ['required', 'image'],
            'position_id' => ['required', 'integer' ,'exists:position_list,id'],
            'short_desc' => ['required', 'string', 'min:8', 'max:50']
        ];
    }

}
