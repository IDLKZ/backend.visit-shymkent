<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function index()
    {
        $routes = Route::where("status",1)->count() >= 4  ? Route::where("status",1)->take(4) : Route::where("status",1)->get();
        return response()->json($routes);
    }
}
