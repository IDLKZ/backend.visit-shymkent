<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Organizator;
use App\Models\Place;
use App\Models\User;
use App\Models\Workday;
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
        $event = Event::with(['galleries',"workdays","workdays.weekday", 'savings'])->firstWhere("alias",$alias);
        return response()->json($event);
    }

    public function myEvents()
    {
        $user = Organizator::where('user_id', auth('api')->id())->first();
        $event1 = Event::with('workdays.weekday')->where(['status' => 1, 'organizator_id' => $user->id])->paginate(10);
        $event2 = Event::with('workdays.weekday')->where(['status' => 0, 'organizator_id' => $user->id])->paginate(10);
        $places = Place::all();
        return response()->json([$event1, $event2, $places, $user]);
    }

    public function sendEvent(Request $request)
    {
        $this->validate($request, [
           'title_kz' => 'required|max:255',
           'title_ru' => 'required|max:255',
           'title_en' => 'required|max:255',
           'place_id' => 'required|exists:places,id',
           'description_kz' => 'required',
           'description_ru' => 'required',
           'description_en' => 'required',
           'image' => 'nullable|image'
        ]);
        $input = $request->all();
        $input['status'] = 0;
        $input['type_id'] = 1;
        $event = Event::add($input);
        if ($input['image']){
            $event->uploadFile($request['image'], 'image');
        }
        $w['event_id'] = $event->id;
        $w['weekday_id'] = 1;
        $w['date_start'] = $input['date'];
        $w['time_start'] = $input['time'];
        Workday::add($w);
    }
}
