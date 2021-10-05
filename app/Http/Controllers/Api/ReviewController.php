<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware("throttle:5")->only("store");

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[ 'user_id'=>"required|sometimes|exists:users,id", 'rating'=>"sometimes|nullable|numeric|min:0|max:5", 'place_id'=>"sometimes|nullable|exists:places,id", 'event_id'=>"sometimes|nullable|exists:events,id", 'route_id'=>"sometimes|nullable|exists:routes,id", 'shop_id'=>"sometimes|nullable|exists:shops,id", 'souvenir_id'=>"sometimes|nullable|exists:souvenirs,id", 'organizator_id'=>"sometimes|nullable|exists:organizators,id", 'news_id'=>"sometimes|nullable|exists:news,id", 'blog_id'=>"sometimes|nullable|exists:blogs,id",]);
        if($user = User::find($request->get("user_id"))){
            if($user->reviews()->where(["status"=>-1])->count()>10){
                return response("Превышение запросов",429);
            }
        }
        $review = new Review();
        $input = $request->all();
        $input["status"] = -1;
        $review->add($input);
        return response()->json($user->reviews()->where(["news_id"=>$request->get("news_id"),"status"=>0])->count()>5);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
