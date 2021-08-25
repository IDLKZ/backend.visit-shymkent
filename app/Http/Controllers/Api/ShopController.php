<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Souvenir;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function mySouvenirs()
    {
        $user = Shop::firstWhere('user_id', auth('api')->id());
        $souvenir1 = Souvenir::with('shop')->where(['status' => 1, 'shop_id' => $user->id])->paginate(10);
        $souvenir2 = Souvenir::with('shop')->where(['status' => 0, 'shop_id' => $user->id])->paginate(10);
        return response()->json([$souvenir1, $souvenir2, $user]);
    }

    public function sendSouvenir(Request $request)
    {
        $this->validate($request, [
           'title_kz' => 'required',
           'title_ru' => 'required',
           'title_en' => 'required',
           'image' => 'required|image',
           'price' => 'required',
           'description_kz' => 'required',
           'description_ru' => 'required',
           'description_en' => 'required'
        ]);
        $input = $request->all();
        $input['status'] = 0;
        $s = Souvenir::add($input);
        $s->uploadFile($input['image'], 'image');
    }
}
