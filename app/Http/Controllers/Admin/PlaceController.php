<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Organizator;
use App\Models\Place;
use App\Models\PlaceEvent;
use App\Models\Setting;
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
        $setting = Setting::find(4);
        $events = Event::all();
        $places = Place::with(["organizator","categoriesPlaces","category"])->whereIn("status",$setting->status)->orderBy("created_at",$setting->order)->where("type_id",1)->paginate($setting->pagination);
        return view('admin.places.index', compact('places',"setting","events"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryPlaces::all();
        $organizators = Organizator::with("role")->get();
        $events = Event::all();
        return view('admin.places.create', compact('categories', 'organizators',"events"));
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
        if($request->events){
            foreach ($request->events as $event){
                PlaceEvent::add(["place_id"=>$place->id,"event_id"=>$event]);

            }
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
        $place = Place::firstWhere(["id"=>$id,"type_id"=>1]);
        if($place){
            $events = Event::whereNotIn("id",$place->events->pluck("id")->toArray())->get();
            $categories = CategoryPlaces::whereNotIn("id",$place->categoriesPlaces->pluck("category_id")->toArray())->get();
            $weekdays = Weekday::all();
            $place->load(["organizator","categoriesPlaces","category","galleries","workdays","ratings","reviews"]);
            return view("admin.places.show",compact("place","weekdays","categories","events"));
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
        $place = Place::with("categoriesPlaces")->firstWhere(["id"=>$id,"type_id"=>1]);
        if($place){
            $categories = CategoryPlaces::all();
            $categories_ids = $place->categoriesPlaces->pluck("category_id")->toArray();
            $organizators = Organizator::where("status","=","1")->with("role")->get();
            return view('admin.places.edit', compact('place', 'organizators', 'categories',"categories_ids"));
        }
        return redirect(route('places.index'));

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
        $place = Place::firstWhere(["id"=>$id,"type_id"=>1]);
        if($place){
            $place->edit($request->all(),'image');
            $place->uploadFile($request['image'], 'image');
            if($request->get("category_id")){
                CategoriesPlaces::where(["place_id" => $id])->delete();
                foreach ($request->category_id as $key => $category){
                    $category = CategoriesPlaces::add(["category_id"=>$category,"place_id"=>$place->id]);
                }
            }
            return redirect(route('places.index'));
        }
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
