<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryOfRoute;
use App\Models\Organizator;
use App\Models\Place;
use App\Models\Route;
use App\Models\RouteAndOrganizator;
use App\Models\RouteAndType;
use App\Models\RoutesType;
use App\Models\TypeOfRoute;
use App\Models\User;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function routes()
    {
        $routes = Route::where("status",1)->count() >= 4  ? Route::where("status",1)->take(4)->get() : Route::where("status",1)->get();
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
        $routes->load('places');
        return response()->json($routes);

    }

    public function guides()
    {
        $guides = Organizator::with('user')->withCount("reviews","routes")->withAvg("ratings","rating")
            ->withAvg("review","rating")
            ->where(['role_id' => 4, 'status' => 1])->paginate(12);
        return response()->json($guides);
    }

    public function agencies()
    {
        $agents = Organizator::with('routes')->withCount("reviews","routes")
            ->withAvg("ratings","rating")->where(['role_id' => 5, 'status' => 1])
            ->withAvg("review","rating")
            ->orderBy("created_at","desc")->paginate(10);
        return response()->json($agents);
    }

    public function route($alias)
    {
        $route = Route::with(['galleries', 'places.galleries', 'routePlace.place', 'savings', 'organizators'])->firstWhere("alias",$alias);
        return response()->json($route);
    }

    public function guide($alias)
    {
        $guide = Organizator::with('user', 'savings', 'routes', 'routes.category', 'routes.typesRoute', 'routes.places','reviews.user','ratings')->firstWhere('alias', $alias);
        return response()->json($guide);
    }

    public function agency($alias)
    {
        $agency = Organizator::with('user', 'savings', 'routes', 'routes.category', 'routes.typesRoute', 'routes.places','reviews.user','ratings')->firstWhere('alias', $alias);
        return response()->json($agency);
    }

    public function categories(){
        $types = TypeOfRoute::where("status",1)->get();
        $categories = CategoryOfRoute::where("status",1)->get();
        return response()->json([$types,$categories]);
    }

    public function myRoutes()
    {
        $user = Organizator::where('user_id', auth('api')->id())->first();
        $data = RouteAndOrganizator::with('route')->where(['organizator_id' => $user->id])->latest()->paginate(10);
        $routes = [];
        $moderation = [];
        foreach ($data as $k => $item) {
            if ($item->route->status == 1){
                $routes[$k] = $item->route;
            }
            if ($item->route->status == -1){
                $moderation[$k] = $item->route;
            }
        }
        $types = TypeOfRoute::where("status",1)->get();
        $categories = CategoryOfRoute::where("status",1)->get();
        $places = Place::where("status",1)->get();
        return response()->json([$user, $routes, $moderation, $types, $categories,$places]);
    }


    public function createRoute(Request $request){
        $this->validate($request,
        [
            'category_id'=>'required|exists:route_categories,id',
            'title_kz' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_en' => 'required|max:255',
            'description_kz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required',
            'image' => 'nullable|image',
        ]
        );
        $input = $request->all();
        $input['status'] = -1;
        $route = Route::add($input);
        if ($input['image']){
            $route->uploadFile($request['image'], 'image');
        }
        if($organizator = Organizator::where('user_id',auth('api')->id())->first()){
            RouteAndOrganizator::add(["route_id"=>$route->id,"organizator_id"=>$organizator->id]);
        }
    }

    public function deleteRoute($id){
        $organizator = Organizator::where("user_id",auth("api")->id())->pluck('id')->toArray();
        $routeOrg = RouteAndOrganizator::whereIn("organizator_id",$organizator)->where("route_id",$id)->first();
        if($routeOrg){
            if(RouteAndOrganizator::where("route_id",$id)->count() <=1){
                $route = Route::destroy($id);
            }
            $routeOrg->destroy();
        }

    }


}
