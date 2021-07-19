<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

        if ($this->getMethod() == 'POST') {
            $rules += [
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'password'=>'required|min:4|max:255',
            ];
        }

        if ($this->getMethod() == 'PUT') {
            dd(\Request::instance()->id);
            $rules += [
                'email' => 'required|email|unique:users,email,'.$this->id,
                'phone' => 'required|unique:users,phone,'.$this->id,
                'password'=>'nullable|nullable|min:4|max:255',
            ];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => (int)$this->boolean("status"),
            'verified' => (int)$this->boolean("verified"),
            'password' => bcrypt($this->get("password")),
        ]);
    }

}
