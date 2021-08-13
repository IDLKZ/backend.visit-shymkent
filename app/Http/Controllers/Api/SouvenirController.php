<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Souvenir;
use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    public function index()
    {
        $routes = Souvenir::with('shop')->where("status",1)->count() >= 4  ? Souvenir::where("status",1)->take(4) : Souvenir::where("status",1)->paginate(8);
        $shops = Shop::with(['souvenirs'])->where(['status' => 1, 'role_id' => 6])->paginate(8);
        $artisans = Shop::with(['souvenirs'])->where(['status' => 1, 'role_id' => 7])->paginate(8);
        return response()->json([$routes,$shops,$artisans]);
    }

    public function souvenir($alias)
    {
        $souvenir = Souvenir::with(['galleries', 'shop.user'])->firstWhere('alias', $alias);
        return response()->json($souvenir);
    }
}
