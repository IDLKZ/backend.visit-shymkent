<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organizator;
use App\Models\Saving;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with('organizators', 'shops')->firstWhere('id', auth('api')->id());
        return response()->json($user);
    }

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

        return response()->json($user->image);
    }

    public function updatePhotoCompany(Request $request)
    {
        $this->validate($request, [
           'photo' => 'required|image|max:10240',
            'role_id' => 'required',
            'user_id' => 'required'
        ]);
        if ($request['role_id'] == 4 || $request['role_id'] == 5){
            $user = Organizator::where(['role_id' => $request['role_id'], 'user_id' => $request['user_id']])->first();
            $user->uploadFile($request['photo'], 'image');
        }
        if ($request['role_id'] == 6 || $request['role_id'] == 7){
            $user = Shop::where(['role_id' => $request['role_id'], 'user_id' => $request['user_id']])->first();
            $user->uploadFile($request['photo'], 'image');
        }

        return response()->json($user->image);
    }

    public function uploadGallery(Request $request)
    {
        return response()->json($request->all());
    }

    public function agency(Request $request)
    {
        $this->validate($request, [
           'title' => 'required',
           'description_kz' => 'required',
           'description_ru' => 'required',
           'description_en' => 'required',
           'address' => 'required'
        ]);
        $input = $request->all();
        $input['title_kz'] = $request->get('title');
        $input['title_ru'] = $request->get('title');
        $input['title_en'] = $request->get('title');
        $agency = Organizator::where(['user_id' => $request->get('user_id'), 'role_id' => $request->get('role_id')])->first();
        $agency->edit($input);
        return true;
    }

    public function guide(Request $request)
    {
        $this->validate($request, [
            'description_kz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required'
        ]);
        $guide = Organizator::where(['user_id' => $request->get('user_id'), 'role_id' => $request->get('role_id')])->first();
        $guide->edit($request->all());
    }

    public function craftman(Request $request)
    {
        $this->validate($request, [
            'description_kz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required'
        ]);
        $craftman = Shop::where(['user_id' => $request->get('user_id'), 'role_id' => $request->get('role_id')])->first();
        $craftman->edit($request->all());
    }

    public function craft(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description_kz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required',
            'address' => 'required'
        ]);
        $craft = Shop::where(['user_id' => $request->get('user_id'), 'role_id' => $request->get('role_id')])->first();
        $craft->edit($request->all());
    }

    public function savings()
    {
        $savings = Saving::with(['blog.tag', 'blog.user', 'organizator.user', 'organizator.routes', 'souvenir', 'shop.souvenirs', 'route.places', 'place.category', 'event.workdays'])->where('user_id', auth('api')->id())->paginate(36);
        return response()->json($savings);
    }

    public function addSave(Request $request)
    {
        return Saving::addSave($request->all());
    }
}
