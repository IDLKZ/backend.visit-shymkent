<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'category_id'=>"required|exists:categorynews,id",
            'author_id'=>"required|exists:users,id",
            'title_kz' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_en' => 'required|max:255',
            'description_kz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['image' => 'sometimes|image|max:10240'];
            $rules += ['images' =>'sometimes|array','images.*' => 'sometimes|image|max:20480'];
        }

        if ($this->getMethod() == 'PUT') {
            $rules += ['image' => 'nullable|image|max:20480'];
        }

        return $rules;
    }


}
