<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeekdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('weekdays')->count() == 0){

            DB::table('weekdays')->insert([

                [
                    'id'=>1,
                    'title_ru' => 'Ежедневно',
                    'title_kz' => 'Күн сайын',
                    'title_en' =>'Everyday',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>2,
                    'title_ru' => 'Определенное время',
                    'title_kz' => 'Белгілі бір уақытта',
                    'title_en' =>'Specified time',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],

                [
                    'id'=>3,
                    'title_ru' => 'Понедельник',
                    'title_kz' => 'Дүйсенбі',
                    'title_en' =>'Monday',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>4,
                    'title_ru' => 'Вторник',
                    'title_kz' => 'Сейсенбі',
                    'title_en' =>'Tuesday',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>5,
                    'title_ru' => 'Среда',
                    'title_kz' => 'Сәрсенбі',
                    'title_en' =>'Wednesday',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>6,
                    'title_ru' => 'Четверг',
                    'title_kz' => 'Бейсенбі',
                    'title_en' =>'Thursday',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>7,
                    'title_ru' => 'Пятница',
                    'title_kz' => 'Жұма',
                    'title_en' =>'Friday',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>8,
                    'title_ru' => 'Суббота',
                    'title_kz' => 'Сенбі',
                    'title_en' =>'Saturday',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>9,
                    'title_ru' => 'Воскресенье',
                    'title_kz' => 'Жексенбі',
                    'title_en' =>'Sunday',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],



            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
