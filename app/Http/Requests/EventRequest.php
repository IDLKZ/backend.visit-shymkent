<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class EventRequest extends FormRequest
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
            'type_id'=>"required|exists:event_types,id",
            'title_kz' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_en' => 'required|max:255',
            'description_kz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required',
            'eventum'=>"sometimes|max:255",
            'address'=>"sometimes|max:255",
            'price'=>"sometimes|max:255",
            'status'=>"required|integer",
        ];

        if (Str::upper($this->getMethod()) == 'POST') {
            $rules += ["category_id"=>"required|array", "category_id.*"=>"required|exists:categoryevents,id"];
            $rules += ['image' => 'sometimes|image|max:10240'];
            $rules += ['images' => 'sometimes|array','images.*' => 'sometimes|image|max:10240'];
        }

        if (Str::lower($this->getMethod()) == 'put' || Str::lower($this->getMethod()) == 'patch') {
            $rules += ['image' => 'nullable|image|max:10240'];
        }

        return $rules;
    }


}
