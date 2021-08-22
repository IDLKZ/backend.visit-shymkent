<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PointRequest;
use App\Models\CategoryPlace as CategoryPlaces;
use App\Models\Gallery;
use App\Models\Organizator;
use App\Models\Place;
use App\Models\Route;
use App\Models\RoutePoint;
use App\Models\Setting;
use App\Models\Weekday;
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
        $setting = Setting::find(10);
        $places = Place::with(["organizator","categoriesPlaces","category"])->whereIn("status",$setting->status)->orderBy("created_at",$setting->order)->where("type_id",2)->paginate($setting->pagination);
        return view('admin.points.index', compact('places',"setting"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizators = Organizator::with("role")->get();
        return view('admin.points.create', compact( 'organizators'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PointRequest $request)
    {
        $place = Place::add($request->all());
        $place->uploadFile($request['image'], 'image');
        if ($request->images){
            foreach ($request->images as $file){
                $gallery = Gallery::add(["place_id"=>$place->id]);
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
        $place = Place::firstWhere(["id"=>$id,"type_id"=>2]);
        if($place){
            $weekdays = Weekday::all();
            $place->load(["organizator","galleries","workdays","ratings","reviews"]);
            return view("admin.points.show",compact("place","weekdays"));
        }
        else{
            return redirect(route('points.index'));
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

        $place = Place::firstWhere(["id"=>$id,"type_id"=>2]);
        if($place){
            $organizators = Organizator::where("status","=","1")->with("role")->get();
            return view('admin.points.edit', compact('place', 'organizators'));
        }
        return redirect(route('points.index'));
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
        $place = Place::firstWhere(["id"=>$id,"type_id"=>2]);
        if($place){
            $place->edit($request->all(),'image');
            $place->uploadFile($request['image'], 'image');
            return redirect(route('points.index'));
        }
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
        Place::destroy($id);
        return redirect()->route("points.index");
    }
}
