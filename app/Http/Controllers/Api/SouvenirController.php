<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organizator;
use App\Models\Shop;
use App\Models\Souvenir;
use App\Role;
use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    public function souvenirs()
    {
        $routes = Souvenir::with('shop')->where("status",1)->count() >= 4  ? Souvenir::where("status",1)->take(4)->get() : Souvenir::where("status",1)->paginate(8);
        return response()->json($routes);
    }

    public function allSouvenirs(Request $request)
    {
        $roles = Role::whereIn("id",[6,7])->get();

        $shops = $request->get("role_id") ? Shop::whereIn("role_id",json_decode($request->get('role_id')))->where("status",1)->pluck("id")->toArray() : Shop::where("status",1)->pluck("id")->toArray();
        $price = $request->get("price") ? json_decode($request->get("price")) : [0,100000000];
        $souvenirs = Souvenir::whereIn("shop_id",$shops)->whereBetween("price",$price)->with('shop')->where("status",1)->orderBy("created_at","desc")->paginate(12);
        return response()->json([$souvenirs,$roles]);
    }

    public function souvenir($alias)
    {
        $souvenir = Souvenir::with(['galleries', 'shop.user', 'savings'])->firstWhere('alias', $alias);
        $souvenirId = $souvenir ? $souvenir->id : 0;
        $souvenirs = Souvenir::with('shop')->where('id', '!=', $souvenirId)->where("status",1)->count() >= 4  ? Souvenir::where("status",1)->where('alias', '!=', $alias)->take(4)->get() : Souvenir::where("status",1)->where('alias', '!=', $alias)->get();
        $souvenirs->load(['galleries', 'shop.user', 'savings']);
        return response()->json([$souvenir,$souvenirs]);
    }

    public function shops()
    {
        $shops = Shop::with(['souvenirs'])->where(['status' => 1, 'role_id' => 6])->paginate(8);
        return response()->json($shops);
    }

    public function shop($alias)
    {
        $souvenirs = Souvenir::with('shop')->where("status",1)->count() >= 4  ? Souvenir::where("status",1)->take(4)->get() : Souvenir::where("status",1)->paginate(8);
        $shops = Shop::with(['souvenirs', 'user', 'savings','ratings','workdays','workdays.weekday'])->firstWhere('alias', $alias);
        return response()->json($shops);
    }

    public function craftmans()
    {
        $craftmans = Shop::with(['souvenirs', 'savings'])->where(['status' => 1, 'role_id' => 7])->paginate(8);
        return response()->json($craftmans);
    }

    public function getRandomCraftman(Request $request){
        $craftId = $request->get("craft_id") ? $request->get("craft_id") : 0;
         $count = $request->get("count") ? $request->get("count") : 2;
        $craftmans = Shop::where(['status' => 1])->where("id","!=",$craftId)->
        inRandomOrder()->withCount("souvenirs")->limit($count)->get();
        return response()->json($craftmans);
    }

    public function craft($alias)
    {
        $craftman = Shop::with(['souvenirs', 'user', 'savings','ratings','workdays','workdays.weekday'])->firstWhere('alias', $alias);
        return response()->json($craftman);
    }
}
