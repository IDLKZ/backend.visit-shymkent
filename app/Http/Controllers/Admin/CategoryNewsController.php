<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryNewsRequest;
use App\Models\CategoryEvents;
use App\Models\CategoryNews;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryNews::paginate(15);
        return view("admin.categorynews.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("admin.categorynews.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryNewsRequest $request)
    {
        $category = CategoryNews::add($request->all());
        $category->uploadFile($request["image"],"image");
        return redirect(route('category-news.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($category = CategoryNews::find($id)){
            return view("admin.categorynews.show",compact("category"));
        }
        else{
            return redirect()->back();
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
        $category = CategoryNews::find($id);
        return view("admin.categorynews.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryNewsRequest $request, $id)
    {
        $category = CategoryNews::find($id);
        $category->edit($request->all(),'image');
        $category->uploadFile($request['image'], 'image');
        return redirect(route('category-news.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryNews::destroy($id);
        return redirect(route('category-news.index'));
    }
}
