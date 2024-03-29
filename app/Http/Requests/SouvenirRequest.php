<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SouvenirRequest extends FormRequest
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
            'category_id'=>"nullable|exists:souvenir_category,id",
            'shop_id'=>"required|exists:shops,id",
            'title_kz' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_en' => 'required|max:255',
            'description_kz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required',
            'price'=>'required|integer|min:1',
            'eventum'=>'sometimes|max:255',
            'status'=>'required|integer'
        ];

        if (Str::upper($this->getMethod()) == 'POST') {
            $rules += ['image' => 'sometimes|image|max:10240'];
            $rules += ["images"=>"sometimes|array",'images.*' => 'required|image|max:10240'];
        }

        if (Str::lower($this->getMethod()) == 'put' || Str::lower($this->getMethod()) == 'patch') {
            $rules += ['image' => 'nullable|image|max:10240'];
        }

        return $rules;
    }


}
