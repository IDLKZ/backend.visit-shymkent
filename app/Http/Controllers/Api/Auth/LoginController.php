<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User as UserResource;
use App\Models\Organizator;
use App\Models\Shop;
use App\Models\User;
use App\Recovery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

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
            'expires_in' => auth('api')->factory()->getTTL() * 60*24
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

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $input = $request->all();
        if ($input['role_id'] != 3){
            $input['status'] = 0;
        }
        $input['password'] = bcrypt($request->get('password'));
        $user = User::add($input);

        $input['description_kz'] = '-';
        $input['description_ru'] = '-';
        $input['description_en'] = '-';

        if ($input['role_id'] == 4 || $input['role_id'] == 7){
            $input['title_kz'] = $request->get('name');
            $input['title_ru'] = $request->get('name');
            $input['title_en'] = $request->get('name');
        }

        if ($input['role_id'] == 4){
            $input['status'] = 0;
            $input['user_id'] = $user->id;
            $input['phone'] = null;
            $data = Organizator::add($input);
        }
        if ($input['role_id'] == 5){
            $this->validate($request, ['title_kz' => 'required|max:255', 'title_ru' => 'required|max:255', 'title_en' => 'required|max:255']);
            $input['status'] = 0;
            $input['user_id'] = $user->id;
            $input['phone'] = null;
            $data = Organizator::add($input);
        }
        if ($input['role_id'] == 6){
            $this->validate($request, ['title_kz' => 'required|max:255', 'title_ru' => 'required|max:255', 'title_en' => 'required|max:255']);
            $input['status'] = 0;
            $input['user_id'] = $user->id;
            $input['phone'] = null;
            $data = Shop::add($input);
        }
        if ($input['role_id'] == 7){
            $input['status'] = 0;
            $input['user_id'] = $user->id;
            $input['phone'] = null;
            $data = Shop::add($input);
        }


    }

    public function recover(Request $request){
        $this->validate($request,["email"=>"required|email"]);
        if($user = User::firstWhere("email",$request->get("email"))){
            $firstRecover = Recovery::firstWhere(["user_id"=>$user->id,"type"=>2]);
            $firstRecover ? $firstRecover->delete() : null;
            $recover = new Recovery();
            $recover->fill(["user_id"=>$user->id,"type"=>2,"code"=>Str::random(16),"expiration_date"=>Carbon::now()->addDay()])->save();
        }
        return true;
    }

    public function resetPassword(Request $request){
        $this->validate($request,["email"=>"required|email","password"=>"required|min:6|max:255","same_password"=>"same:password|min:6|max:255","code"=>"required"]);
        if($user = User::firstWhere("email",$request->get("email"))){
            $firstRecover = Recovery::firstWhere(["user_id"=>$user->id,"type"=>2,"code"=>$request->get("code")]);
            if ($firstRecover){
                if($firstRecover->expiration_date > Carbon::now()){
                    $firstRecover->delete();
                    $user->password = bcrypt($request->get("password"));
                    $user->save();
                    return true;
                }
                else{
                    return response()->json([
                        'errors' => [
                            'expired' => ['Ключ устарел, отправьте заново']
                        ]
                    ], 422);
                }
            }
            else{
                return response()->json([
                    'errors' => [
                        'expired' => ['Ключ или почта недействительны']
                    ]
                ], 422);
            }
        }
        else{
            return response()->json([
                'errors' => [
                    'expired' => ['Ключ или почта недействительны']
                ]
            ], 422);
        }




    }




    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
