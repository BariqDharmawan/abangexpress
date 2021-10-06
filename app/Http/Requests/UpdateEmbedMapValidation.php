<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateEmbedMapValidation extends FormRequest
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

    protected function prepareForValidation()
    {
        $beforeEmbed = Str::of($this->address_embed)->before('<iframe');
        $afterEmbed = Str::of($this->address_embed)->after('</iframe>');

        $embededWithoutBeforeAfter = Str::of($this->address_embed)
                                    ->remove($beforeEmbed)->remove($afterEmbed);

        $this->merge([
            'address_embed' => $embededWithoutBeforeAfter
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_embed' => ['required']
        ];
    }

}
