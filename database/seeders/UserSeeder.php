<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('users')->count() == 0){

            DB::table('users')->insert([

                [
                    'id'=>1,
                    'role_id' => 1,
                    'name' => 'Администратор',
                    'email' =>'admin@gmail.com',
                    "phone"=>"+7777777777",
                    "password"=>bcrypt("admin123"),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],



            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }

    }
}
