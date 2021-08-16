<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteAndOrganizator extends FormRequest
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
            "organizator_id"=>"required|exists:organizators,id",
            "route_id"=>"required|exists:routes,id"
        ];
    }
}
