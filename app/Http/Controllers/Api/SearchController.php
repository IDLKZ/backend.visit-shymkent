<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index($searchTerm)
    {
        $tables = [
            'Блог' => 'blogs',
            'Маршруты' => 'routes',
            'Места' => 'places',
            'События' => 'events',
            'Новость' => 'news',
            'Организаторы' => 'organizators',
            'Магазины' => 'shops',
            'Сувениры' => 'souvenirs'
        ];
        $data = [];

        foreach ($tables as $k => $table) {
            $data['results'][$k] = DB::table($table)->where('status', 1)
                ->where('title_ru', 'LIKE', "%{$searchTerm}%")
                ->orWhere('title_kz', 'LIKE', "%{$searchTerm}%")
                ->orWhere('title_en', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description_kz', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description_ru', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description_en', 'LIKE', "%{$searchTerm}%")
                ->paginate(2);
        }
        $count = 0;
        foreach ($data['results'] as $item) {
            $count+=$item->total();
        }
        $data['count'] = $count;
        return response()->json($data);
    }
}
