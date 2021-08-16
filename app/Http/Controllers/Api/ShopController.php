<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop($alias)
    {
        $shops = Shop::with(['souvenirs', 'user'])->firstWhere('alias', $alias);
        return response()->json($shops);
    }
}