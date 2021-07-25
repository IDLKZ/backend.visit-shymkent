<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SouvenirRequest;
use App\Models\Gallery;
use App\Models\Shop;
use App\Models\Souvenir;
use App\Models\SouvenirCategory;
use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $souvenirs = Souvenir::paginate(15);
        return view("admin.souvenirs.index",compact("souvenirs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = SouvenirCategory::all();
        $shops = Shop::all();
        return view("admin.souvenirs.create",compact("categories","shops"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SouvenirRequest $request)
    {
        $souvenir = Souvenir::add($request->all());
        $souvenir->uploadFile($request['image'], 'image');
        foreach ($request->images as $file){
            $gallery = Gallery::add(["souvenir_id"=>$souvenir->id]);
            $gallery->uploadFile($file,"image");
        }
        return redirect()->route("souvenirs.index");

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
        $souvenir = Souvenir::find($id);
        $categories = SouvenirCategory::all();
        $shops = Shop::all();
        return view("admin.souvenirs.edit",compact("categories","shops","souvenir"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SouvenirRequest $request, $id)
    {
        $souvenir = Souvenir::find($id);
        $souvenir->edit($request->all(),'image');
        $souvenir->uploadFile($request['image'], 'image');
        return redirect()->route("souvenirs.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Souvenir::destroy($id);
        return redirect()->route("souvenirs.index");
    }
}
