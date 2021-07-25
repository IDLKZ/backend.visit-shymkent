<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorySouvenirRequest;
use App\Models\SouvenirCategory;
use Illuminate\Http\Request;

class CategorySouvenirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = SouvenirCategory::paginate(15);
        return view("admin.categorysouvenir.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categorysouvenir.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategorySouvenirRequest $request)
    {
        $category = SouvenirCategory::add($request->all());
        $category->uploadFile($request["image"],"image");
        return redirect(route('category-souvenir.index'));
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
        $category = SouvenirCategory::find($id);
        return view("admin.categorysouvenir.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategorySouvenirRequest $request, $id)
    {
        $category = SouvenirCategory::find($id);
        $category->edit($request->all(),'image');
        $category->uploadFile($request['image'], 'image');
        return redirect(route('category-souvenir.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SouvenirCategory::destroy($id);
        return redirect()->route("category-souvenir.index");
    }
}
