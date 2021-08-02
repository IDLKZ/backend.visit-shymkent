<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user', 'tag')->where("status",1)->paginate(12);
        return response()->json($blogs);
    }
}
