<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Place;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function index()
    {
        $places = Place::with('category')->paginate(15);
        return response()->json($places);
    }

    public function singlePlace($alias)
    {
        $place = Place::with('category', 'galleries', 'ratings', 'workdays', 'workdays.weekday', 'user', 'events', 'events.workdays', 'events.workdays.weekday', 'savings')->where('alias', $alias)->first();
        return response()->json($place);
    }

}
