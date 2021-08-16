<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Models\Gallery;
use App\Models\Organizator;
use App\Models\Place;
use App\Models\User;
use App\Models\Weekday;
use App\Models\CategoryPlace as CategoryPlaces;
use App\Models\CategoriesPlace as CategoriesPlaces;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::paginate(15);
        return view('admin.places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryPlaces::all();
        $organizators = Organizator::where("status","=","1")->with("role")->get();
        return view('admin.places.create', compact('categories', 'organizators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceRequest $request)
    {
        $place = Place::add($request->all());
        $place->uploadFile($request['image'], 'image');
        if ($request->images){
            foreach ($request->images as $file){
                $gallery = Gallery::add(["place_id"=>$place->id]);
                $gallery->uploadFile($file,"image");
            }
        }
        foreach ($request->category_id as $key => $category){
            $category = CategoriesPlaces::add(["category_id"=>$category,"place_id"=>$place->id]);
        }
        return redirect(route('places.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::find($id);
        $categories = CategoryPlaces::whereNotIn("id",$place->categoriesPlaces->pluck("category_id")->toArray())->get();
        $weekdays = Weekday::all();
        if($place){
            return view("admin.places.show",compact("place","weekdays","categories"));
        }
        else{
            return redirect(route('places.index'));
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
        $place = Place::find($id);
        $categories = CategoryPlaces::all();
        $organizators = Organizator::where("status","=","1")->with("role")->get();
        return view('admin.places.edit', compact('place', 'organizators', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaceRequest $request, $id)
    {
//        dd($request->all());
        $place = Place::find($id);
        $place->edit($request->all(),'image');
        $place->uploadFile($request['image'], 'image');
        return redirect(route('places.index'));
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
        return redirect()->route("places.index");
    }
}
