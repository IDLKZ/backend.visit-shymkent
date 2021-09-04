<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryPlace;
use App\Models\Email;
use App\Models\Partner;
use App\Models\Phone;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $data['categories'] = CategoryPlace::where("parent_id",null)->get();
        $data['phones'] = Phone::all();
        $data['emails'] = Email::all();
        $data['partners'] = Partner::all();
        return response()->json($data);
    }
}
