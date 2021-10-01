<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CategoryEvents;
use App\Models\CategoryNews;
use App\Models\CategoryOfRoute;
use App\Models\CategoryPlace as CategoryPlaces;
use App\Models\Event;
use App\Models\News;
use App\Models\Organizator;
use App\Models\Place;
use App\Models\Route;
use App\Models\Shop;
use App\Models\Slider;
use App\Models\Souvenir;
use App\Models\SouvenirCategory;
use App\Models\Tag;
use App\Models\TypeOfRoute;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function user(Request $request){
       $users = User::search([
           ["role_id","in",$request->get("role_id")],
           ["name","like",$request->get("name")],
           ["email","like",$request->get("email")],
           ["phone","like",$request->get("phone")],
           ["description","like",$request->get("description")],
           ["status","in",$request->get("status")]
           ])->paginate($request->get("pagination"));

        $users->appends(request()->query());
        return view("admin.search.user",compact("users"));
    }

    public function slider(Request $request){
        $sliders = Slider::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["button_ru","like",$request->get("button_ru")],
            ["button_kz","like",$request->get("button_kz")],
            ["button_en","like",$request->get("button_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["link","like",$request->get("link")],
            ["number","in",$request->get("number")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));

        $sliders->appends(request()->query());
        return view("admin.search.sliders",compact("sliders"));
    }

    public function categoryPlace(Request $request){
        $categoryPlaces = CategoryPlaces::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));

        $categoryPlaces->appends(request()->query());
        return view("admin.search.categoryPlaces",compact("categoryPlaces"));
    }

    public function place(Request $request){
        $places = Place::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["video_ru","like",$request->get("video_ru")],
            ["video_kz","like",$request->get("video_kz")],
            ["video_en","like",$request->get("video_en")],
            ["audio_ru","like",$request->get("audio_ru")],
            ["audio_kz","like",$request->get("audio_kz")],
            ["audio_en","like",$request->get("audio_en")],
            ["price","like",$request->get("price")],
            ["address","like",$request->get("address")],
            ["eventum","like",$request->get("eventum")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")],
            ["type_id","exact",1]
        ])->paginate($request->get("pagination"));

        $places->appends(request()->query());
        return view("admin.search.place",compact("places"));
    }

    public function categoryEvent(Request $request){
        $eventCategories = CategoryEvents::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));

        $eventCategories->appends(request()->query());
        return view("admin.search.categoryEvents",compact("eventCategories"));
    }

    public function event(Request $request){
        $events = Event::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["price","like",$request->get("price")],
            ["address","like",$request->get("address")],
            ["eventum","like",$request->get("eventum")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $events->appends(request()->query());
        return view("admin.search.event",compact("events"));
    }

    public function eventum(Request $request){
        $events = Event::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["price","like",$request->get("price")],
            ["address","like",$request->get("address")],
            ["eventum","like",$request->get("eventum")],
            ["event_id","like",$request->get("event_id")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $events->appends(request()->query());
        return view("admin.search.eventum",compact("events"));
    }

    public function routeCategories(Request $request){
        $categories = CategoryOfRoute::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $categories->appends(request()->query());
        return view("admin.search.routeCategories",compact("categories"));
    }

    public function routeTypes(Request $request){
        $categories = TypeOfRoute::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $categories->appends(request()->query());
        return view("admin.search.routeTypes",compact("categories"));
    }

    public function route(Request $request){
        $routes = Route::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["alias","like",$request->get("alias")],
            ["eventum","like",$request->get("eventum")],
            ["time","like",$request->get("time")],
            ["distance","like",$request->get("distance")],
            ["address","like",$request->get("address")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        return view("admin.search.route",compact("routes"));

    }

    public function point(Request $request){
        $places = Place::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["address","like",$request->get("address")],
            ["eventum","like",$request->get("eventum")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")],
            ["type_id","exact",2]
        ])->paginate($request->get("pagination"));

        $places->appends(request()->query());
        return view("admin.search.point",compact("places"));
    }

    public function shop(Request $request){
        $shops = Shop::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["address","like",$request->get("address")],
            ["eventum","like",$request->get("eventum")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $shops->appends(request()->query());
        return view("admin.search.shop",compact("shops"));
    }

    public function categorySouvenir(Request $request){
        $categories = SouvenirCategory::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $categories->appends(request()->query());
        return view("admin.search.categorySouvenir",compact("categories"));
    }

    public function souvenir(Request $request){
        $souvenirs = Souvenir::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["price","like",$request->get("price")],
            ["alias","like",$request->get("alias")],
            ["eventum","like",$request->get("eventum")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $souvenirs->appends(request()->query());
        return view("admin.search.souvenir",compact("souvenirs"));
    }

    public function organizator(Request $request){
        $organizators = Organizator::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["education_ru","like",$request->get("education_ru")],
            ["education_kz","like",$request->get("education_kz")],
            ["education_en","like",$request->get("education_en")],
            ["alias","like",$request->get("alias")],
            ["eventum","like",$request->get("eventum")],
            ["address","like",$request->get("address")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $organizators->appends(request()->query());
        return view("admin.search.organizator",compact("organizators"));
    }

    public function categoryNews(Request $request){
        $categories = CategoryNews::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $categories->appends(request()->query());
        return view("admin.search.categoryNews",compact("categories"));
    }

    public function news(Request $request){
        $news = News::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $news->appends(request()->query());
        return view("admin.search.news",compact("news"));
    }

    public function tag(Request $request){
        $tags = Tag::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $tags->appends(request()->query());
        return view("admin.search.tag",compact("tags"));
    }

    public function blog(Request $request){
        $blogs = Blog::search([
            ["title_ru","like",$request->get("title_ru")],
            ["title_kz","like",$request->get("title_kz")],
            ["title_en","like",$request->get("title_en")],
            ["description_ru","like",$request->get("description_ru")],
            ["description_kz","like",$request->get("description_kz")],
            ["description_en","like",$request->get("description_en")],
            ["alias","like",$request->get("alias")],
            ["status","in",$request->get("status")]
        ])->paginate($request->get("pagination"));
        $blogs->appends(request()->query());
        return view("admin.search.blog",compact("blogs"));
    }

}
