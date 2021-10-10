<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriesPlace;
use App\Models\Gallery;
use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function index(Request $request)
    {
        if($request->get("categories")){
            $place_id = CategoriesPlace::whereIn('category_id',json_decode($request->get("categories")))->pluck("place_id")->toArray();
        }
        else{
            $place_id = CategoriesPlace::pluck("place_id")->toArray();
        }
        $places = Place::with('category')->whereIn("id",$place_id)
            ->where("title_ru","like","%".$request->get("search") . "%")
            ->where("status",1)
            ->withAvg("ratings","rating")
            ->withAvg(array('reviews' => function($query) {$query->where('status', '=', 1);}),"rating")
            ->orderBy("created_at",$request->get("order"))->paginate(12);


        return response()->json($places);
    }

    public function singlePlace($alias)
    {
        $place = Place::with('category', 'galleries', 'ratings', 'workdays', 'workdays.weekday', 'user', 'events', 'events.workdays', 'events.workdays.weekday', 'savings')->where('alias', $alias) ->withAvg("ratings","rating")
            ->withAvg(array('reviews' => function($query) {$query->where('status', '=', 1);}),"rating")->first();
        $reviews = $place->reviews()->where("status",1)->orderBy("created_at","DESC")->with("user")->paginate(20);
        return response()->json([$place,$reviews]);
    }

    public function getDefinePlace(Request $request){

        $place_id = $request->get("place_id") ? $request->get("place_id") : 0;
        $category = CategoriesPlace::where("place_id",$place_id)->pluck("category_id")->toArray();
        $placesID = CategoriesPlace::whereIn("category_id",$category)->pluck("place_id")->toArray();
        $count = $request->get("count") ? $request->get("count") : 2;
        $places = Place::where('status',1)->where("id","!=",$place_id)->whereIn("id",$placesID)->with('category')->inRandomOrder()->take($count)
            ->withAvg("ratings","rating")
            ->withAvg(array('reviews' => function($query) {$query->where('status', '=', 1);}),"rating")
            ->get();
        return response()->json($places);


    }

}
