<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function index()
    {
        $places = Place::with('category')->paginate(15);
        return response()->json($places);
    }
}
