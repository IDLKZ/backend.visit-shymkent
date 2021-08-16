<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
           'email' => 'required|email|unique:users,email,'.auth('api')->id(),
           'phone' => 'required|unique:users,phone,'.auth('api')->id(),
           'password'=>'sometimes|min:4|max:255',
        ]);
        $input = $request->all();
        if ($request->get('password')){
            $input['password'] = bcrypt($request->get("password"));
        }
        $input['role_id'] = auth('api')->user()->role_id;
        $user = User::find($request['id']);
        $user->edit($input);

        return true;
    }

    public function updatePhoto(Request $request)
    {
        $this->validate($request, [
           'image' => 'required|image|max:10240'
        ]);
        $user = User::find($request['id']);
        $user->uploadFile($request['image'], 'image');
        return true;
    }
}
