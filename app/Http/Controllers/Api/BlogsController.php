<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BlogRequest;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user', 'tag')->where("status",1)->paginate(12);
        return response()->json($blogs);
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
}
