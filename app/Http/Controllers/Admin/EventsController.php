<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\CategoryEvent;
use App\Models\CategoryEvents;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Gallery;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(15);
        return view("admin.events.index",compact("events"));
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
        return view("admin.events.create",compact("types","categories"));
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
        foreach ($request->images as $file){
            $gallery = Gallery::add(["event_id"=>$event->id]);
            $gallery->uploadFile($file,"image");
        }
        foreach ($request->category_id as $key => $category){
            $category = CategoryEvent::add(["category_id"=>$category,"event_id"=>$event->id]);
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
        $types = EventType::all();
        return view("admin.events.edit",compact("event","types"));

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
        $event->edit($request->all(),'image');
        $event->uploadFile($request['image'], 'image');
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
        Event::destroy($id);
        return redirect()->route("events.index");
    }
}
