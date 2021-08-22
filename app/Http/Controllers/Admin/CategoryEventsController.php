<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventCategoryRequest;
use App\Models\CategoryEvents;
use App\Models\Setting;
use Illuminate\Http\Request;

class CategoryEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(5);
        $eventCategories = CategoryEvents::whereIn("status",$setting->status)->orderBy("created_at",$setting->order)->paginate($setting->pagination);
        return view("admin.eventcategories.index",compact("eventCategories","setting"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view("admin.eventcategories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventCategoryRequest $request)
    {
        $category = CategoryEvents::add($request->all());
        $category->uploadFile($request["image"],"image");
        return redirect(route('category-events.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = CategoryEvents::find($id);
        if($category){
            return view("admin.eventcategories.show",compact("category"));
        }
        else{
            toastWarning(__("messages.404"));
        }
        return redirect(route('category-events.index'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryEvents::find($id);
        if($category){
            return view("admin.eventcategories.edit",compact("category"));
        }
        else{
            toastWarning(__("messages.404"));
        }
        return redirect(route('category-events.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventCategoryRequest $request, $id)
    {
        $category = CategoryEvents::find($id);
        if($category){
            $category->edit($request->all(),'image');
            $category->uploadFile($request['image'], 'image');
        }
        else{
            toastWarning(__("messages.404"));
        }
        return redirect(route('category-events.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryEvents::destroy($id);
        return redirect()->back();
    }
}
