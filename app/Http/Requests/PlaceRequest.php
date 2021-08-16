<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
            'organizator_id'=>"required|exists:organizators,id",
            'title_kz' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_en' => 'required|max:255',
            'description_kz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ["category_id"=>"required|array", "category_id.*"=>"required|exists:categoryplaces,id"];
            $rules += ['image' => 'required|image|max:10240'];
            $rules += ['images.*' => 'required|image|max:20480'];
        }

        if ($this->getMethod() == 'PUT') {
            $rules += ['image' => 'nullable|image|max:20480'];
        }

        return $rules;
    }
}
