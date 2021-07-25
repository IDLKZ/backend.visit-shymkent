<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('event_types')->count() == 0){

            DB::table('event_types')->insert([

                [
                    'id'=>1,
                    'title_ru' => 'Мероприятие',
                    'title_kz' => 'Іс-шара',
                    'title_en' =>'Activity',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id'=>2,
                    'title_ru' => 'Услуга',
                    'title_kz' => 'Қызмет',
                    'title_en' =>'Service',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],




            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
