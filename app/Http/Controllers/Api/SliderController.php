<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $slider = Slider::where("status",1)->orderBy("number","ASC")->get();
        return response()->json($slider);
    }
}
