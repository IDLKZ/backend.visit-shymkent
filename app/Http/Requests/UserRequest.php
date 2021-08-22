<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UserRequest extends FormRequest
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
            "role_id"=>"required|exists:roles,id",
            "image"=>"nullable|sometimes|image|max:10240",
            "name"=>"required|max:255"
        ];

        if (Str::upper($this->getMethod()) == 'POST') {
            $rules += [
                'email' => 'required|email|unique:users,email|max:255',
                'phone' => 'sometimes|nullable|unique:users,phone|max:255',
                'password'=>'required|min:4|max:255',
            ];
        }
        if (Str::lower($this->getMethod()) == 'put' || Str::lower($this->getMethod()) == 'patch') {
            $rules += [
                'email' => 'required|email|unique:users,email,'.(int)$this->segment(4),
                'phone' => 'sometimes|nullable|required|unique:users,phone,'.(int)$this->segment(4),
                'password'=>'nullable|sometimes|min:4|max:255',
            ];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'verified' => (int)$this->boolean("verified"),
            'status' => (int)$this->boolean("status"),
            'password' => Str::length($this->get("password"))  > 4 ? bcrypt($this->get("password")) : null,
        ]);
    }

}
