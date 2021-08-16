<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryOfRoute;
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
        $categories = CategoryOfRoute::paginate(15);
        return view("admin.categoriesofroute.index",compact("categories"));
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
        return view("admin.categoriesofroute.show",compact("category"));

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
        return view("admin.categoriesofroute.edit",compact("category"));
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
