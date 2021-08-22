<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryOfRoute;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryOfRouteRequest;

class CategoriesOfRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(7);
        $categories = CategoryOfRoute::whereIn("status",$setting->status)->orderBy("created_at",$setting->order)->paginate($setting->pagination);
        return view("admin.categoriesofroute.index",compact("categories","setting"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categoriesofroute.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryOfRouteRequest $request)
    {
        $category = CategoryOfRoute::add($request->all());
        $category->uploadFile($request["image"],"image");
        return redirect()->route("route_categories.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = CategoryOfRoute::find($id);
        if($category){
            return view("admin.categoriesofroute.show",compact("category"));
        }
        return redirect()->route("route_categories.index");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryOfRoute::find($id);
        if($category){
            return view("admin.categoriesofroute.edit",compact("category"));
        }
        return redirect()->route("route_categories.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryOfRouteRequest $request, $id)
    {
        $category = CategoryOfRoute::find($id);
        if($category){
            $category->edit($request->all(),'image');
            $category->uploadFile($request['image'], 'image');
        }
        return redirect()->route("route_categories.index");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryOfRoute::destroy($id);
        return redirect()->back();

    }
}
