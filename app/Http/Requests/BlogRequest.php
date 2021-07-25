<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'tag_id'=>"required|exists:tags,id",
            'author_id'=>"required|exists:users,id",
            'title_kz' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_en' => 'required|max:255',
            'description_kz' => 'required|max:255',
            'description_ru' => 'required|max:255',
            'description_en' => 'required|max:255',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['image' => 'required|image|max:10240'];
            $rules += ['images.*' => 'required|image|max:10240'];
        }

        if ($this->getMethod() == 'PUT') {
            $rules += ['image' => 'nullable|image|max:10240'];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => (int)$this->boolean("status"),
        ]);
    }
}
