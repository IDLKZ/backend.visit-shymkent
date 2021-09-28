<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryEvents;
use App\Models\Cron;
use App\Models\Event;
use App\Models\EventType;
use App\Models\EventumEvent;
use App\Models\Organizator;
use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CronController extends Controller
{
    public function events(){
        $events = Event::where("event_id",'!=',null)->paginate(15);
        return view("admin.cron.eventum",compact("events"));
    }

    public function getAllEvents(Request $request){
        $events = Cron::getLatestEvents();
        toastSuccess(__("messages.success"));
        return redirect()->back();
    }

    public function checkEvent($eventId){
        Cron::checkEvent($eventId);
        return redirect()->back();
    }

}
