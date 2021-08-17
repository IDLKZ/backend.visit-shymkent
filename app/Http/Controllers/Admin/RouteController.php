<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RouteRequest;
use App\Models\CategoryOfRoute;
use App\Models\Gallery;
use App\Models\Organizator;
use App\Models\Route;
use App\Models\RouteAndOrganizator;
use App\Models\RouteAndType;
use App\Models\TypeOfRoute;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::with(["types.routeType","organizatorsRoute.organizator.role"])->paginate(15);
        return view("admin.routes.index",compact("routes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryOfRoute::all();
        $types = TypeOfRoute::all();
        $organizators = Organizator::with("role")->get();
        return view("admin.routes.create",compact("categories","types","organizators"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteRequest $request)
    {
        $route = Route::add($request->all());
        $route->uploadFile($request['image'], 'image');
        if ($request->images){
            foreach ($request->images as $file){
                $gallery = Gallery::add(["route_id"=>$route->id]);
                $gallery->uploadFile($file,"image");
            }
        }
        if($request->types){
            foreach ($request->types as $type){
                RouteAndType::add(["type_id"=>$type,"route_id"=>$route->id]);
            }
        }
        if($request->organizators){
            foreach ($request->organizators as $organizator){
                RouteAndOrganizator::add(["organizator_id"=>$organizator,"route_id"=>$route->id]);
            }
        }
        return redirect(route('routes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($route = Route::find($id)){
            $route->load((["types.routeType","organizatorsRoute.organizator.role","routePoints"]));
            $organizators = Organizator::whereNotIn("id",$route->organizatorsRoute->pluck("organizator_id"))->get();
            $types = TypeOfRoute::whereNotIn("id",$route->types->pluck("type_id"))->get();
            return view("admin.routes.show",compact("route","organizators","types"));
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
        $route = Route::find($id);
        $categories = CategoryOfRoute::all();
        return view("admin.routes.edit",compact("route","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RouteRequest $request, $id)
    {
        $route = Route::find($id);
        $route->edit($request->all(),'image');
        $route->uploadFile($request['image'], 'image');
        return redirect(route('routes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Route::destroy($id);
        return  redirect()->back();
    }
}
