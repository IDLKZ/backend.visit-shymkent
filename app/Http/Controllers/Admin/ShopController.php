<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Gallery;
use App\Models\Shop;
use App\Models\ShopUser;
use App\Models\User;
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
        $shops = Shop::paginate(15);
        return view("admin.shops.index",compact("shops"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereNotIn('role_id', [1,2])->get();
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
        foreach ($request->images as $file){
            $gallery = Gallery::add(["shop_id"=>$shop->id]);
            $gallery->uploadFile($file,"image");
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
        //
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
        $users = User::whereNotIn('role_id', [1,2])->get();
        $roles = Role::whereIn('id', [6,7])->get();
        return view("admin.shops.edit",compact("roles","shop","users"));
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
        $shop->edit($request->all(),'image');
        $shop->uploadFile($request['image'], 'image');
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
