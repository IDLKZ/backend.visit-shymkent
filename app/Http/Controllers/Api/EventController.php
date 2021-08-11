<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events = Event::where("status",1)->count() >= 4  ? Event::where("status",1)->take(4) : Event::where("status",1)->get();
        $events->load(["workdays","workdays.weekday"]);
        return response()->json($events);
    }


    public function events(Request  $request){
        $events = Event::where("status",1)->orderBy("created_at","DESC")->paginate(8);
        $events->load(["workdays","workdays.weekday"]);
        return response()->json($events);
    }



    public function event($alias){
        $event = Event::with(['galleries',"workdays","workdays.weekday"])->firstWhere("alias",$alias);
        return response()->json($event);
    }
}
