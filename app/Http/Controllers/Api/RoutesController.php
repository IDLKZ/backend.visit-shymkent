<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organizator;
use App\Models\Route;
use App\Models\User;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function index()
    {
        $routes = Route::where("status",1)->count() >= 4  ? Route::where("status",1)->take(4) : Route::where("status",1)->get();
        $guides = Organizator::with('user')->where('role_id', 4)->paginate(10);
        $agents = Organizator::with('user')->where('role_id', 5)->paginate(10);
        return response()->json([$routes, $guides, $agents]);
    }

    public function route($alias)
    {
        $route = Route::with(['galleries', 'routePoints', 'routePoints.galleries'])->firstWhere("alias",$alias);
        return response()->json($route);
    }
}
