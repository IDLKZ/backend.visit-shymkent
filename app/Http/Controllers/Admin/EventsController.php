<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\CategoryEvent;
use App\Models\CategoryEvents;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Gallery;
use App\Models\Organizator;
use App\Models\Place;
use App\Models\PlaceEvent;
use App\Models\Setting;
use App\Models\User;
use App\Models\Weekday;
use Carbon\Carbon;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(6);
        $events = Event::with(["organizator","eventType","categoriesEvents","galleries","ratings","reviews"])->whereIn("status",$setting->status)->orderBy("created_at",$setting->order)->paginate($setting->pagination);
        return view("admin.events.index",compact("events","setting"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryEvents::all();
        $types = EventType::all();
        $organizators = Organizator::where("status",1)->with("user")->get();
        $places = Place::all();
        return view("admin.events.create",compact("types","categories", 'organizators',"places"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $event = Event::add($request->all());
        $event->uploadFile($request['image'], 'image');
        if($request->images){
            foreach ($request->images as $file){
                $gallery = Gallery::add(["event_id"=>$event->id]);
                $gallery->uploadFile($file,"image");
            }
        }
        foreach ($request->category_id as $key => $category){
            $category = CategoryEvent::add(["category_id"=>$category,"event_id"=>$event->id]);
        }
        if($request->places){
            foreach ($request->places as $place){
                PlaceEvent::add(["event_id"=>$event->id,"place_id"=>$place]);
            }
        }
        return redirect(route('events.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::with(["organizator","eventType","categoriesEvents","galleries","ratings","reviews"])->find($id);
        if($event){
            $organizators =
            $categories = CategoryEvents::whereNotIn("id",$event->categoryEvent->pluck("category_id")->toArray())->get();
            $types = EventType::all();
            $weekdays = Weekday::all();
            $places = Place::whereNotIn("id",$event->places->pluck("id")->toArray())->get();
            return view("admin.events.show",compact("event","types","weekdays","categories","places"));
        }
        else{
            return redirect(route('events.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        if($event){
            $types = EventType::all();
            $organizators = Organizator::where("status",1)->with("user")->get();
            $places = Place::where("status",1)->get();
            return view("admin.events.edit",compact("event","types", 'organizators',"places"));
        }
        else{
            return redirect()->route("events.index");
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        $event = Event::find($id);
        if($event){
            $event->edit($request->all(),'image');
            $event->uploadFile($request['image'], 'image');
            if($event->eventumEvent){
                $status = $request->get("status") == 1 ? 1 : 0;
                $event->eventumEvent->update(["status"=>$status,"last_updated"=>Carbon::now()]);
            }
        }
        return redirect(route('events.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->eventumEvent->destroy();
        Event::destroy($id);
        return redirect()->route("events.index");
    }
}
