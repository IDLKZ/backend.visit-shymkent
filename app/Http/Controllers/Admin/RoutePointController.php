<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PointRequest;
use App\Models\Gallery;
use App\Models\Route;
use App\Models\RoutePoint;
use Illuminate\Http\Request;

class RoutePointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $points = RoutePoint::paginate(15);
        return  view("admin.points.index",compact("points"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes = Route::all();
        return  view("admin.points.create",compact("routes"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PointRequest $request)
    {
        $point = RoutePoint::add($request->all());
        $point->uploadFile($request['image'], 'image');
        if ($request->images){
            foreach ($request->images as $file){
                $gallery = Gallery::add(["point_id"=>$point->id]);
                $gallery->uploadFile($file,"image");
            }
        }
        return redirect(route('points.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($point = RoutePoint::find($id)){
            return view("admin.points.show",compact("point"));
        }
        else{
            return  redirect()->back();
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
        $routes = Route::all();
        $point = RoutePoint::find($id);
        return view("admin.points.edit",compact("point","routes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PointRequest $request, $id)
    {
        $point = RoutePoint::find($id);
        $point->edit($request->all(),'image');
        $point->uploadFile($request['image'], 'image');
        return redirect(route('points.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RoutePoint::destroy($id);
        return redirect()->route("points.index");
    }
}
