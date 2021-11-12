<?php

namespace App\Http\Requests;

use App\Helper\Helper;
use App\Models\OurSocial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSocialMediaValidation extends FormRequest
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
        $isAccountExistOnThisDomain = OurSocial::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['platform', $this->platform],
        ])->select('platform')->count() > 0;

        // dd($isAccountExistOnThisDomain);

        return [
            'icon' => ['required', 'string', 'starts_with:fa', 'min:4'],
            'platform' => [
                'required',
                'in:' . implode(',', Helper::getListSocialPlatform()),
                Rule::when($isAccountExistOnThisDomain, ['unique:our_socials,platform'])
            ],
            'username' => ['required', 'string', 'min:3', 'max:40']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'platform.unique' => 'Kamu telah memasukan platform ' . $this->platform,
            'icon.min' => 'Please pick a valid :attribute',
            'icon.starts_with' => 'Please pick a valid :attribute starts with "fa"',
        ];
    }
}
