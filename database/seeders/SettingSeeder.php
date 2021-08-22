<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('settings')->count() == 0){

            DB::table('settings')->insert([

                [
                    'id'=>1,
                    'type' => 'user',
                    'title' => 'Пользователи/Users',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>2,
                    'type' => 'sliders',
                    'title' => 'Слайдеры/Sliders',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>3,
                    'type' => 'category-place',
                    'title' => 'Категория путеводителя /Category of Place',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>4,
                    'type' => 'places',
                    'title' => 'Путеводитель/Place',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>5,
                    'type' => 'category-events',
                    'title' => 'Категория событий/Category of Event',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>6,
                    'type' => 'events',
                    'title' => 'События/Event',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>7,
                    'type' => 'route_categories',
                    'title' => ' Категория Маршрутов /Category of Route',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>8,
                    'type' => 'route_types',
                    'title' => ' Тип Маршрутов /Types of Route',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>9,
                    'type' => 'routes',
                    'title' => ' Маршруты /Routes',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>10,
                    'type' => 'points',
                    'title' => ' Точки Маршрутов /Point Route',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>11,
                    'type' => 'shops',
                    'title' => ' Магазины и ремесленики /Shops',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>12,
                    'type' => 'category-souvenir',
                    'title' => 'Категория Сувениров/Category of the Souvenir',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>13,
                    'type' => 'souvenirs',
                    'title' => 'Сувениры/Souvenirs',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>14,
                    'type' => 'organizators',
                    'title' => 'Гиды и турагенства/Guide and Tour Agency',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>15,
                    'type' => 'category-news',
                    'title' => 'Категория новостей/Category News',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>16,
                    'type' => 'news',
                    'title' => 'Новости/News',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>17,
                    'type' => 'tags',
                    'title' => 'Тэги/Tags',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>18,
                    'type' => 'blogs',
                    'title' => 'Блог/Blogs',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>19,
                    'type' => 'reviews',
                    'title' => 'Мнения/Reviews',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>20,
                    'type' => 'partners',
                    'title' => 'Партнеры/Partners',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],


            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
