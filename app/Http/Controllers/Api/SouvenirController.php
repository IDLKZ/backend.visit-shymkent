<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Souvenir;
use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    public function souvenirs()
    {
        $routes = Souvenir::with('shop')->where("status",1)->count() >= 4  ? Souvenir::where("status",1)->take(4) : Souvenir::where("status",1)->paginate(8);
        return response()->json($routes);
    }

    public function souvenir($alias)
    {
        $souvenir = Souvenir::with(['galleries', 'shop.user', 'savings'])->firstWhere('alias', $alias);
        return response()->json($souvenir);
    }

    public function shops()
    {
        $shops = Shop::with(['souvenirs'])->where(['status' => 1, 'role_id' => 6])->paginate(8);
        return response()->json($shops);
    }

    public function shop($alias)
    {
        $shops = Shop::with(['souvenirs', 'user', 'savings'])->firstWhere('alias', $alias);
        return response()->json($shops);
    }

    public function craftmans()
    {
        $craftmans = Shop::with(['souvenirs', 'savings'])->where(['status' => 1, 'role_id' => 7])->paginate(8);
        return response()->json($craftmans);
    }

    public function craft($alias)
    {
        $craftman = Shop::with(['souvenirs', 'user', 'savings'])->firstWhere('alias', $alias);
        return response()->json($craftman);
    }
}
