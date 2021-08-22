<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Gallery;
use App\Models\Setting;
use App\Models\Shop;
use App\Models\ShopUser;
use App\Models\User;
use App\Models\Weekday;
use App\Role;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(11);
        $shops = Shop::whereIn("status",$setting->status)->orderBy("created_at",$setting->order)->paginate($setting->pagination);
        return view("admin.shops.index",compact("shops","setting"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereIn('role_id', [6,7])->whereNotIn("id",Shop::pluck("user_id")->toArray())->get();
        $roles = Role::whereIn('id', [6,7])->get();
        return view("admin.shops.create",compact("users","roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {

        $shop = Shop::add($request->all());
        $shop->uploadFile($request['image'], 'image');
        if($request->images){
            foreach ($request->images as $file){
                $gallery = Gallery::add(["shop_id"=>$shop->id]);
                $gallery->uploadFile($file,"image");
            }
        }
        return redirect(route('shops.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($shop = Shop::find($id)){
            $weekdays = Weekday::all();
            return view("admin.shops.show",compact("shop","weekdays"));
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
        $shop = Shop::find($id);
        if($shop){
            $users = User::whereIn('role_id', [6,7])->whereNotIn("id",Shop::pluck("user_id")->toArray())->get();
            $roles = Role::whereIn('id', [6,7])->get();
            return view("admin.shops.edit",compact("roles","shop","users"));
        }
        return redirect()->route("shops.index");

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, $id)
    {
        $shop = Shop::find($id);
        if($shop){
            $shop->edit($request->all(),'image');
            $shop->uploadFile($request['image'], 'image');
        }
        return redirect(route('shops.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shop::destroy($id);
        return redirect()->route("shops.index");
    }
}
