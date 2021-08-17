<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organizator;
use App\Models\Route;
use App\Models\User;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function routes()
    {
        $routes = Route::where("status",1)->count() >= 4  ? Route::where("status",1)->take(4) : Route::where("status",1)->get();
        return response()->json($routes);
    }

    public function guides()
    {
        $guides = Organizator::with('user')->where('role_id', 4)->paginate(10);
        return response()->json($guides);
    }

    public function agencies()
    {
        $agents = Organizator::with('routes.routePoints')->where('role_id', 5)->paginate(10);
        return response()->json($agents);
    }

    public function route($alias)
    {
        $route = Route::with(['galleries', 'routePoints', 'routePoints.galleries', 'savings', 'organizators'])->firstWhere("alias",$alias);
        return response()->json($route);
    }

    public function guide($alias)
    {
        $guide = Organizator::with('user', 'savings', 'routes', 'routes.category', 'routes.typesRoute', 'routes.routePoints')->firstWhere('alias', $alias);
        return response()->json($guide);
    }

    public function agency($alias)
    {
        $agency = Organizator::with('user', 'savings', 'routes', 'routes.category', 'routes.typesRoute', 'routes.routePoints')->firstWhere('alias', $alias);
        return response()->json($agency);
    }
}
