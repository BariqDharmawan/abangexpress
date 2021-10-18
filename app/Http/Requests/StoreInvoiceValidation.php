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
            'desc' => ['required', 'string', 'min:2'],
            'quantity' => ['required', 'numeric', 'integer', 'min:1'],
            'unit' => ['required'],
            'value_unit' => ['required'],
        ];
    }
}
