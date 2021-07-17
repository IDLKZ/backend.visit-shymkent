<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_places', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("category_id")->references("id")->on("categoryPlaces")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("place_id")->references("id")->on("places")->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('categories_places');
    }
}
