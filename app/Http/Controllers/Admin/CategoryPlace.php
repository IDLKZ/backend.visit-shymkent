<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceCategoryRequest;
use App\Models\CategoryPlace as CategoryPlaces;

class CategoryPlace extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryPlaces = CategoryPlaces::paginate(15);

        return view('admin.placecategories.index', compact('categoryPlaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryPlaces::getTree();
        $option = CategoryPlaces::renderTemplate($categories);

//        dd($categories);
//        dd($option);
        return view('admin.placecategories.create', compact('categories', 'option'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceCategoryRequest $request)
    {
        $category = CategoryPlaces::add($request->all());
        $category->uploadFile($request["image"],"image");
        return redirect(route('category-place.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = CategoryPlaces::find($id);
        return view('admin.placecategories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryPlaces::find($id);
        $categories = CategoryPlaces::getTree();
        $option = CategoryPlaces::renderTemplate($categories, null, $category);
        return view('admin.placecategories.edit', compact('category', 'option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaceCategoryRequest $request, $id)
    {
        $category = CategoryPlaces::find($id);
        $category->edit($request->all(),'image');
        $category->uploadFile($request['image'], 'image');
        return redirect(route('category-place.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryPlaces::destroy($id);
        return redirect()->back();
    }
}
