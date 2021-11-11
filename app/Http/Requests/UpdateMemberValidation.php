<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpaceRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberValidation extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:150', new AlphaSpaceRule],
            'avatar_edit' => ['sometimes','image'],
            'position_id_edit' => ['required', 'integer' ,'exists:position_list,id'],
            'short_desc' => ['required', 'string', 'min:3', 'max:50']
        ];
    }

}
