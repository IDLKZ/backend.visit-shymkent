<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PartnerRequest extends FormRequest
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
        $rules  = [
            "title"=>"required|max:255",
            "alias"=>"nullable|url|max:255",
        ];

        if (Str::upper($this->getMethod()) == 'POST') {
            $rules += ['image' => 'sometimes|image|max:10240'];
        }

        if (Str::lower($this->getMethod()) == 'put' || Str::lower($this->getMethod()) == 'patch') {
            $rules += ['image' => 'nullable|image|max:10240'];
        }
        return $rules;
    }
}
