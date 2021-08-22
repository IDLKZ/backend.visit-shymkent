<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icons = collect(["fab fa-facebook-square"=>"Facebook", "fab fa-instagram-square"=>"Instagram", "fab fa-vk"=>"VK", "fas fa-envelope-square"=>"Email", "fab fa-linkedin"=>"LinkedIn", "fab fa-whatsapp-square"=>"WhatsApp", "fab fa-twitter-square"=>"Twitter", "fab fa-youtube-square"=>"Youtube"]);
        $socials = Social::all();
        return view("admin.socials.index",compact("socials","icons"));
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
        $this->validate($request,["alias"=>"required|url|max:255","icon"=>"required|max:255"]);
        $social = Social::add($request->all());
        return redirect()->back();
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
        $this->validate($request,["alias"=>"required|url|max:255","icon"=>"required|max:255"]);
        if($social = Social::find($id)){
            $social->edit($request->all());
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Social::destroy($id);
        return  redirect()->back();
    }
}
