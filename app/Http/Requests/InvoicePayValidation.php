<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoicePayValidation extends FormRequest
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
            'account_name' => ['required', 'string', 'in:bca,mandiri,bni'],
            'total_payed' => ['required', 'integer', 'min:100'],
            'proof_of_paying' => ['required', 'mimes:jpg,png,jpeg,webp']
        ];
    }
}
