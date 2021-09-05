<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Blog;
use App\Models\News;
use App\Models\Organizator;
use App\Models\Review;
use App\Models\Saving;
use App\Models\Setting;
use App\Models\Shop;
use App\Models\Slider;
use App\Models\User;
use App\Recovery;
use App\Role;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $setting = Setting::find(1);
        $users = User::whereIn("status",$setting->status)->whereIn("verified",$setting->verified)->with(["role"])->orderBy("created_at",$setting->order)->paginate($setting->pagination);

        return view("admin.user.index",compact("users","setting","roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view("admin.user.create",compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::add($request->all());
        $user->uploadFile($request['image'], 'image');
        return redirect(route('admin-user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($user = User::find($id)){
            $user->load(["blogs","news","organizators","recoveries","savings","reviews","shops"]);
            return view("admin.user.show",compact("user"));
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        if($user){
            return view("admin.user.edit",compact("roles","user"));
        }
        else{
            return redirect()->route("admin-user.index");
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        if($user){
            $input = $request->get("password") != null ? $request->all() : $request->except("password");
            $user->edit($input,'image');
            $user->uploadFile($request['image'], 'image');
        }
        return redirect(route('admin-user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back();
    }
}
