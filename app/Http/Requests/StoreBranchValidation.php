<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchValidation extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'icon' => ['required', 'file', 'mimes:jpg,png,jpeg,webp,svg', 'max:1048'],
            'telephone' => ['required', 'numeric', 'digits_between:8,16'],
            'address' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'icon.max' => ':attribute tidak boleh lebih dari 1mb'
        ];
    }
}
