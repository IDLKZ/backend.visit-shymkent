<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkdayRequest extends FormRequest
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
            "weekday_id"=>"required|exists:weekdays,id",
            "shop_id"=>"sometimes|exists:shops,id",
            "place_id"=>"sometimes|exists:places,id",
            "point_id"=>"sometimes|exists:route_points,id",
            "event_id"=>"sometimes|exists:events,id"
        ];
    }
}
