<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BlogRequest;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::search([
            ["tag_id","in",$request->tag_id],
            ["status","in",1]
        ])->with('user', 'tag')->orderBy(
            "created_at", ($request->exists("order") == true ? $request->get("order") : "desc")
        )->paginate(12);
        return response()->json($blogs);
    }

    public function singleBlog($alias){
        $blog = Blog::where("status",1)->with("user","tag",'savings')->firstWhere("alias",$alias);
        $blogs = Blog::where("status",1)->count() >2 ? Blog::where("status",1)->orderBy("created_at","desc")->with("user","tag")->take(3)->get() : Blog::where("status",1)->orderBy("created_at","desc")->with("user","tag")->get();
        $reviews = $blog->reviews()->where("status",1)->orderBy("created_at","DESC")->with("user")->paginate(20);
        return response()->json([$blog,$blogs,$reviews]);
    }





    public function myBlogs()
    {
        $blogs = Blog::with('tag')->where(['status' => 1, 'author_id' => auth('api')->id()])->paginate(10);
        $tags = Tag::all();
        $blogs2 = Blog::with('tag')->where(['status' => 0, 'author_id' => auth('api')->id()])->paginate(10);
        return response()->json([$blogs, $tags, $blogs2]);
    }

    public function sendBlog(BlogRequest $request)
    {
        $input = $request->all();
        $input['status'] = 0;
        $blog = Blog::add($input);
        $blog->uploadFile($input['image'], 'image');
        return true;
    }

    public function authors(Request $request){
        $tags = $request->get("tag_id") ? json_decode($request->get("tag_id")) : [];
        $blogs = Blog::where("status",1)->whereIn("tag_id",$tags)->pluck("author_id")->toArray();
        $authors = User::whereIn("id",$blogs)->where("name","like","%" . $request->get("search") ."%")->with(array('blogs' => function($query) {
            $query->where('status','1')->with("tag");
        }))->paginate(16);
        return response()->json($authors);

    }

}
