<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactValidation extends FormRequest
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
            'address' => ['sometimes', 'string', 'min:8', 'max:200'],
            'telephone' => ['sometimes', 'digits_between:8,15'],
            'email' => ['sometimes', 'string', 'email:rfc,dns', 'max:45'],
            'link_address' => ['sometimes', 'url']
        ];
    }
}
