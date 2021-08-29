<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriesPlace;
use App\Models\Gallery;
use App\Models\Place;
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
            ->orderBy("created_at",$request->get("order"))->paginate(12);
        return response()->json($places);
    }

    public function singlePlace($alias)
    {
        $place = Place::with('category', 'galleries', 'ratings', 'workdays', 'workdays.weekday', 'user', 'events', 'events.workdays', 'events.workdays.weekday', 'savings')->where('alias', $alias)->first();
        return response()->json($place);
    }

}
