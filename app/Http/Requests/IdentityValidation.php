<?php

namespace App\Http\Requests;

use App\Models\TemplateChoosen;
use App\Rules\AlphanumericSpace;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $templateChoosen = TemplateChoosen::select('version')->where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first()->version;

        return [
            'our_name' => ['sometimes', 'string', 'min:3', 'max:50'],
            'our_vision' => ['required', 'string', 'min:3'],
            'our_mission' => ['required', 'string', 'min:3'],
            'sub_slogan' => ['sometimes', 'string', 'min:3', 'max:255'],
            'cover_vision_mission' => ['sometimes', 'image', 'max:2000'],
            'first_desc' => ['required', 'string', 'min:3'],
            'section_name' => ['required', 'string', new AlphanumericSpace],
            'second_desc' => [Rule::when($templateChoosen == 2, ['required'], ['nullable']), 'string', 'min:3']
        ];
    }

}
