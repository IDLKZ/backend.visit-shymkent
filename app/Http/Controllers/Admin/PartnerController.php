<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Models\Partner;
use App\Models\Setting;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(20);
        $partners = Partner::orderBy("created_at",$setting->order)->paginate($setting->pagination);
        return view("admin.partners.index",compact("partners","setting"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.partners.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        $partner = Partner::add($request->all());
        $partner->uploadFile($request['image'], 'image');
        return redirect()->route("partners.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($partner = Partner::find($id)){
            return view("admin.partners.show",compact("partner"));
        }
        return redirect()->route("partners.index");


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($partner = Partner::find($id)){
            return view("admin.partners.edit",compact("partner"));
        }
        return redirect()->route("partners.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerRequest $request, $id)
    {
        if($partner = Partner::find($id)){
          $partner->edit($request->all(),"image");
          if ($request['image']){
              $partner->upload($request["image"],"image");
          }
        }
        return redirect()->route("partners.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Partner::destroy($id);
        return redirect()->back();
    }
}
