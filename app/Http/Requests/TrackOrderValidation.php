<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackOrderValidation extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'receipt_number' => ['required', 'string', 'min:3', 'max:30', 'alpha_num']
        ];
    }
}
