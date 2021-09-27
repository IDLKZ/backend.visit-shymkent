<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'organizator_id'=>"nullable|exists:organizators,id",
            'title_kz' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_en' => 'required|max:255',
            'description_kz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required',
            'eventum'=>"sometimes|max:255",
            "audio_kz"=>"sometimes|nullable|url|max:255",
            "audio_ru"=>"sometimes|nullable|url|max:255",
            "audio_en"=>"sometimes|nullable|url|max:255",
            "video_kz"=>"sometimes|nullable|url|max:255",
            "video_ru"=>"sometimes|nullable|url|max:255",
            "video_en"=>"sometimes|nullable|url|max:255",
            "address"=>"sometimes|nullable|max:255",
            'status'=>"required|integer",
            'sites.*' => 'sometimes|nullable|url',
            'social_networks.*' => 'sometimes|nullable|url'
        ];

        if (Str::upper($this->getMethod()) == 'POST') {
            $rules += ["category_id"=>"required|array", "category_id.*"=>"required|exists:categoryplaces,id"];
            $rules += ['image' => 'sometimes|image|max:10240'];
            $rules += ['images.*' => 'sometimes|image|max:20480'];
        }

        if (Str::lower($this->getMethod()) == 'put' || Str::lower($this->getMethod()) == 'patch') {
            $rules += ['image' => 'nullable|image|max:20480'];
        }

        return $rules;
    }
}
