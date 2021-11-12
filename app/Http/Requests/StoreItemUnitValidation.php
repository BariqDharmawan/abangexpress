<?php

namespace App\Http\Requests;

use App\Models\ItemUnit;
use App\Rules\AlphaSpaceRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreItemUnitValidation extends FormRequest
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
        $isUnitExistOnThisDomain = ItemUnit::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['name', $this->name],
        ])->select('name')->count() > 0;

        return [
            'name' => [
                'required', 'string', 'min:2',
                Rule::when($isUnitExistOnThisDomain, ['unique:item_units,name']),
                new AlphaSpaceRule
            ]
        ];
    }

    public function messages()
    {
        return [
            'unique' => 'Unit tidak boleh sama'
        ];
    }
}
