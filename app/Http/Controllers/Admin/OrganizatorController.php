<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizatorRequest;
use App\Models\Gallery;
use App\Models\Organizator;
use App\Models\Setting;
use App\Models\User;
use App\Role;
use Illuminate\Http\Request;

class OrganizatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(14);
        $organizators = Organizator::whereIn("status",$setting->status)->orderBy("created_at",$setting->order)->paginate($setting->pagination);
        return view("admin.organizators.index",compact("organizators","setting"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereIn("id",[4,5])->get();
        $users = User::whereIn('role_id',[4,5])->whereNotIn("id",Organizator::pluck("user_id")->toArray())->with("role")->get();
        return view("admin.organizators.create",compact("roles","users"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizatorRequest $request)
    {
        $organizator = Organizator::add($request->all());
        $organizator->uploadFile($request['image'], 'image');
        if ($request->images){
            foreach ($request->images as $file){
                $gallery = Gallery::add(["organizator_id"=>$organizator->id]);
                $gallery->uploadFile($file,"image");
            }
        }
        return redirect(route('organizators.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($organizator = Organizator::find($id)){
            return view("admin.organizators.show",compact("organizator"));
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
        $organizator = Organizator::find($id);
        if($organizator){
            $roles = Role::whereIn("id",[4,5])->get();
            $users = User::whereIn('role_id',[4,5])->whereNotIn("id",Organizator::pluck("user_id")->toArray())->with("role")->get();
            return view("admin.organizators.edit",compact("roles","users","organizator"));
        }
        return redirect()->route("organizators.index");

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizatorRequest $request, $id)
    {
        $organizaor = Organizator::find($id);
        if($organizaor){
            $organizaor->edit($request->all(),'image');
            $organizaor->uploadFile($request['image'], 'image');
        }
            return redirect()->route("organizators.index");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Organizator::destroy($id);
        return redirect()->route("organizators.index");
    }
}
