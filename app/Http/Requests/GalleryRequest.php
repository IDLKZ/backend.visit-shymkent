<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
        return [
                'place_id'=>"sometimes|nullable|exists:places,id",
            'event_id'=>"sometimes|nullable|exists:events,id",
            'route_id'=>"sometimes|nullable|exists:routes,id",
            'point_id'=>"sometimes|nullable|exists:route_points,id",
            'shop_id'=>"sometimes|nullable|exists:shops,id",
            'souvenir_id'=>"sometimes|nullable|exists:souvenirs,id",
            'organizator_id'=>"sometimes|nullable|exists:organizators,id",
            'news_id'=>"sometimes|nullable|exists:news,id",
            'blog_id'=>"sometimes|nullable|exists:blogs,id",
            'image'=>"required|image|max:100000",

        ];
    }
}
