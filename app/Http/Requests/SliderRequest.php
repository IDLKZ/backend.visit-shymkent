<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SliderRequest extends FormRequest
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
        $rules = [
            'title_kz' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_en' => 'required|max:255',
            'description_kz' => 'required|max:500',
            'description_ru' => 'required|max:500',
            'description_en' => 'required|max:500',
            'button_kz' => 'required|max:255',
            'button_ru' => 'required|max:255',
            'button_en' => 'required|max:255',
            'link' => 'required|url',
            'number' => 'required|integer',
        ];

        if (Str::upper($this->getMethod()) == 'POST') {
            $rules += ['image' => 'required|image|max:10240'];
        }

        if (Str::lower($this->getMethod()) == 'put' || Str::lower($this->getMethod()) == 'patch') {
            $rules += ['image' => 'nullable|image|max:10240'];
        }

        return $rules;
    }




}
