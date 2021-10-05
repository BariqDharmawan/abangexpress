<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdentityValidation extends FormRequest
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
            'our_name' => ['sometimes', 'string', 'min:3', 'max:50'],
            'our_vision' => ['sometimes', 'string', 'min:3'],
            'our_mission' => ['sometimes', 'string', 'min:3'],
            'sub_slogan' => ['sometimes', 'string', 'min:3', 'max:255'],
            'our_video' => ['sometimes', 'url', 'starts_with:https://www.youtube.com/watch?']
        ];
    }
}
