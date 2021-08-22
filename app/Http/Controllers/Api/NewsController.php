<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryNews;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('user', 'categorynews')->where("status",1)->take(4)->get();
        return response()->json($news);
    }

    public function allNews()
    {
        $news = News::with('user', 'categorynews')->where('status', 1)->paginate(8);
        $categories = CategoryNews::all();
        return response()->json([$news,$categories]);
    }

    public function singleNew($alias)
    {
        $new = News::with('savings', 'user')->firstWhere('alias', $alias);
        return response()->json($new);
    }
}
