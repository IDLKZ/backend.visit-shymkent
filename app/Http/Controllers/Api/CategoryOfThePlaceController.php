<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryPlace;
use Illuminate\Http\Request;

class CategoryOfThePlaceController extends Controller
{
    public function index(){
        $categoryoftheplace = CategoryPlace::where("parent_id",null)->get();
        return response()->json($categoryoftheplace);
    }
}
