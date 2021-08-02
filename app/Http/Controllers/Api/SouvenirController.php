<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Souvenir;
use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    public function index()
    {
        $routes = Souvenir::where("status",1)->count() >= 4  ? Souvenir::where("status",1)->take(4) : Souvenir::where("status",1)->get();
        return response()->json($routes);
    }
}
