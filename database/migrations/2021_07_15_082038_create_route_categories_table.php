<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_categories', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->string("title_ru");
            $table->string("title_kz");
            $table->string("title_en");
            $table->string("image");
            $table->string("alias");
            $table->integer("string");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_categories');
    }
}
