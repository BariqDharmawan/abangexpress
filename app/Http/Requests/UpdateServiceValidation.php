<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceValidation extends FormRequest
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
            'icon' => ['required', 'string', 'starts_with:fa'],
            'title' => ['required', 'string', 'min:3', 'max:20'],
            'desc' => ['required', 'string', 'min:5'],
        ];
    }
}
