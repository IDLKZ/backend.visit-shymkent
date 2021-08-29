<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryOfRoute;
use App\Models\Organizator;
use App\Models\Route;
use App\Models\RouteAndType;
use App\Models\RoutesType;
use App\Models\TypeOfRoute;
use App\Models\User;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function routes()
    {
        $routes = Route::where("status",1)->count() >= 4  ? Route::where("status",1)->take(4) : Route::where("status",1)->get();
        return response()->json($routes);
    }

    public function allRoutes(Request $request)
    {
        $category = $request->get("category_id") ? json_decode($request->get("category_id")) : CategoryOfRoute::pluck("id")->toArray();
        $types = $request->get("types") ? RoutesType::whereIn("type_id",json_decode($request->get("types")))->pluck("route_id")->toArray() : Route::pluck("id")->toArray();
        $time = $request->get("time") ? json_decode($request->get("time")) : [0,10000];
        $routes = Route::whereIn("category_id",$category)
            ->whereIn("category_id",$category)
            ->whereIn("id",$types)
            ->whereBetween('time',$time)
            ->orderBy("created_at","desc")->paginate(12);

        return response()->json($routes);

    }

    public function guides()
    {
        $guides = Organizator::with('user')->withCount("reviews","routes")->withAvg("ratings","rating")->where('role_id', 4)->paginate(12);
        return response()->json($guides);
    }

    public function agencies()
    {
        $agents = Organizator::with('routes')->withCount("reviews","routes")->withAvg("ratings","rating")->where('role_id', 5)->orderBy("created_at","desc")->paginate(10);
        return response()->json($agents);
    }

    public function route($alias)
    {
        $route = Route::with(['galleries', 'places.galleries', 'routePlace.place', 'savings', 'organizators'])->firstWhere("alias",$alias);
        return response()->json($route);
    }

    public function guide($alias)
    {
        $guide = Organizator::with('user', 'savings', 'routes', 'routes.category', 'routes.typesRoute', 'routes.places')->firstWhere('alias', $alias);
        return response()->json($guide);
    }

    public function agency($alias)
    {
        $agency = Organizator::with('user', 'savings', 'routes', 'routes.category', 'routes.typesRoute', 'routes.places')->firstWhere('alias', $alias);
        return response()->json($agency);
    }

    public function categories(){
        $types = TypeOfRoute::where("status",1)->get();
        $categories = CategoryOfRoute::where("status",1)->get();
        return response()->json([$types,$categories]);
    }
}
