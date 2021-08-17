<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeOfRoute;
use Illuminate\Http\Request;
use App\Http\Requests\TypeOfRouteRequest;

class TypesOfRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = TypeOfRoute::paginate(15);
        return view("admin.typesofroute.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.typesofroute.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeOfRouteRequest $request)
    {
        $category = TypeOfRoute::add($request->all());
        $category->uploadFile($request["image"],"image");
        return redirect()->route("route_types.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = TypeOfRoute::with(["routesTypes.route"])->find($id);
        return view("admin.typesofroute.show",compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = TypeOfRoute::find($id);
        return view("admin.typesofroute.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeOfRouteRequest $request, $id)
    {
        $category = TypeOfRoute::find($id);
        if($category){
            $category->edit($request->all(),'image');
            $category->uploadFile($request['image'], 'image');
        }
        return redirect()->route("route_types.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TypeOfRoute::destroy($id);
        return redirect()->back();
    }
}
