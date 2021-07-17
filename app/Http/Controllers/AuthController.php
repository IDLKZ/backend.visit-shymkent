<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use App\Models\User;
use App\Recovery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function login(){
        return view("auth.login");
    }


    public function register(){
        return view("auth.register");
    }



    public function auth(Request $request){
         $this->validate($request, ["email"=>"required|email","password"=>"required"]);
         if(Auth::attempt(["email"=>$request->email,"password"=>$request->password],$request->boolean("remember_me"))){
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
                return redirect("");
            }
         }
         else{
             toastError(__("messages.login_error"));
             return redirect()->back();
         }
    }



    public function registerUser(Request $request){
        $this->validate($request, ["name"=>"required|min:1|max:500", "email"=>"required|email|unique:users,email|min:1|max:500", "phone"=>"required|unique:users,phone|min:1|max:500", "password"=>"required|min:4|max:500", ]);
        if($new_id = User::createFromRegister($request)){
            if($verification_id = Recovery::newUserVerification($new_id)){
                if($recovery = Recovery::find($verification_id)){
                    try {
                        Mail::to($recovery->user->email)->send(new VerificationEmail($recovery));
                        toastSuccess("messages.email_success");
                    }
                    catch(\Exception $e) {
                        toastError(__("messages.email_error"));
                    }
                }
            }
            else{
                toastError(__("messages.failed"));
            }
            return redirect()->route("login");
        }
        else{
            toastError(__("messages.register_error"));
            return redirect()->back();
        }





    }



    public function verifyEmail($alias){
        $recovery = Recovery::firstWhere("code",$alias);
        if($recovery){
            if(Carbon::parse($recovery->expiration_date) > Carbon::now()){
                $recovery->user->verified = 1;
                $recovery->user->save();
                toastSuccess(__("messages.email_confirmed"));
            }
            else{
                toastError(__("messages.key_expired"));
            }
            $recovery->delete();
            return redirect()->route("login");
        }
        else{
            abort(404);
        }
    }


    public function forgot(){
        return view("auth.forgot");
    }

    public function recoverPassword(Request $request){
        $this->validate($request, ["email"=>"required|email"]);
        if($user = User::firstWhere("email",$request->email)){
            if($verification_id = Recovery::recoverAccount($user->id)){
                if($recovery = Recovery::find($verification_id)){
                    try {
                        Mail::to($recovery->user->email)->send(new VerificationEmail($recovery));
                        toastSuccess("messages.email_success");
                    }
                    catch(\Exception $e) {
                        toastError(__("messages.email_error"));
                    }
                }
            }
            else{
                toastError(__("messages.failed"));
            }
            return redirect()->route("login");
        }


    }



    public function recoverEmail($alias){
        $recovery = Recovery::firstWhere(["code"=>$alias,"type"=>2]);
        if($recovery){
            if(Carbon::parse($recovery->expiration_date) > Carbon::now()){
                return view("auth.recover",compact("recovery"));
            }
            else{
                $recovery->delete();
                toastError(__("messages.key_expired"));
                abort(404);
            }
        }
        else{
            abort(404);
        }
    }

    public function recover(Request $request){
        $this->validate($request, ["password"=>"required|min:4|max:500","same_password"=>"required|same:password",
            "code"=>"required|exists:recoveries,code"
            ]);
        if($recovery = Recovery::firstWhere("code",$request->code)){
            if($user = User::find($recovery->user_id)){
                $user->password = bcrypt($request->password);
                $user->save();
                $recovery->delete();
                toastSuccess(__("messages.new_password"));
                return redirect()->route("login");
            }
            else{
                toastError(__("messages.failed"));
                return redirect()->back();
            }
        }
        else{
            toastError(__("messages.failed"));
            return redirect()->back();
        }



    }



}
