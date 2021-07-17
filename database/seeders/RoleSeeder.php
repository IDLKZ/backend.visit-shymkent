<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('roles')->count() == 0){

            DB::table('roles')->insert([

                [
                    'id'=>1,
                    'title_ru' => 'Администратор',
                    'title_kz' => 'Администратор',
                    'title_en' =>'Administrator',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>2,
                    'title_ru' => 'Модератор',
                    'title_kz' => 'Модератор',
                    'title_en' =>'Moderator',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>3,
                    'title_ru' => 'Пользователь',
                    'title_kz' => 'Пользователь',
                    'title_en' =>'User',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>4,
                    'title_ru' => 'Гид',
                    'title_kz' => 'Гид',
                    'title_en' =>'Guide',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>5,
                    'title_ru' => 'Турагенство',
                    'title_kz' => 'Турагенство',
                    'title_en' =>'Travel Agency',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>6,
                    'title_ru' => 'Магазин',
                    'title_kz' => 'Дүкен',
                    'title_en' =>'Shop',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>7,
                    'title_ru' => 'Ремесленник',
                    'title_kz' => 'Қолөнерші',
                    'title_en' =>'Handicraft',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>8,
                    'title_ru' => 'Объект',
                    'title_kz' => 'Объект',
                    'title_en' =>'Object',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],


            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }

    }
}
