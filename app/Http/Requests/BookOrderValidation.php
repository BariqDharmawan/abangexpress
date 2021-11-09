<?php

namespace App\Http\Requests;

use App\Rules\WithoutSpace;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookOrderValidation extends FormRequest
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
            'sender_name' => ['required'],
            'sender_telephone' => ['required'],
            'recipient_name' => ['required'],
            'recipient_telephone' => ['required'],
            'recipient_nik' => [
                Rule::requiredIf(
                    $this->recipient_country == 'TAIWAN' or
                    $this->recipient_country == 'KOREA SOUTH' or
                    $this->recipient_country == 'INDIA'
                ),
                'string',
                'max:40',
                new WithoutSpace
            ],
            'recipient_zipcode' => ['required'],
            'recipient_country' => ['required'],
            'recipient_address' => ['required'],
            'idcard_input_hidden' => ['sometimes'],
            'package_length' => ['required', 'numeric', 'min:1'],
            'package_width' => ['required', 'numeric', 'min:1'],
            'package_height' => ['required', 'numeric', 'min:1'],
            'package_weight' => ['required', 'numeric', 'min:1'],
            'package_type' => ['required'],
            'package_detail' => ['required'],
            'package_koli' => ['required'],
            'package_value' => ['required'],
            'courier' => ['required_if:recipient_country,TAIWAN']
        ];
    }
}
