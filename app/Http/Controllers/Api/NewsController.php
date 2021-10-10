<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryNews;
use App\Models\News;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('user', 'categorynews')->where("status",1)->take(4)->get();
        return response()->json($news);
    }

    public function allNews(Request $request)
    {
        $news = News::search([['status',"in",1], ["category_id","in",$request->get("category_id")]])->with('user', 'categorynews')->orderBy("created_at","DESC")->paginate(12);
        $categories = CategoryNews::all();
        $hotNews = News::search([['status',"in",1], ["category_id","in",$request->get("category_id")]])->with('user', 'categorynews')->orderBy("created_at","DESC")->first();
        return response()->json([$news,$categories,$hotNews]);
    }

    public function singleNew($alias)
    {
        $new = News::with('savings', 'user',"galleries")->where('alias', $alias)->firstOrFail();
        $reviews = $new->reviews()->where("status",1)->orderBy("created_at","DESC")->with("user")->paginate(20);
        return response()->json([$new,$reviews]);
    }

    public function testUpload(Request $request){
        $this->validate($request,["image"=>"required|image|max:10240"]);
        $user = User::find(11);
        $user->uploadFile($request->image,'image');
        return response()->json($user->image);
    }

    public function moreNews(Request $request){
        $newsId = $request->get("news_id") ?  $request->get("news_id") : 0;
        $news =  News::where("id","!=",$newsId)->with('user', 'categorynews')->orderBy("created_at","DESC")->take(3)->get();
        return response()->json($news);

    }
}
