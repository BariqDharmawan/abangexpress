<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceValidation extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'desc' => ['required', 'string', 'min:5'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit' => ['required'],
            'value_unit' => ['required'],
        ];
    }
}
