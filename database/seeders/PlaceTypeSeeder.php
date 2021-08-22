<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('place_type')->count() == 0){

            DB::table('place_type')->insert([

                [
                    'id'=>1,
                   'title_ru'=>"Место",
                   'title_kz'=>"Орын",
                   'title_en'=>"Place",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>2,
                    'title_ru'=>"Точка маршрута",
                    'title_kz'=>"Бағыт нүктесі",
                    'title_en'=>"Point of route",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],



            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }

    }
}
