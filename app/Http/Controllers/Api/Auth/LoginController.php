<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        if (!$token = auth('api')->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => [
                    'fail' => ['Неправильные данные']
                ]
            ], 422);
        }

        return response()->json([
            'meta' => [
                'token' => $token
            ],
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);

//        return (new UserResource($request->user()))->additional([
//            'meta' => [
//                'token' => $token
//            ]
//        ]);

    }

    public function user(Request $request) {
        return new UserResource($request->user());
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
