<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutePlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_place', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("route_id")->references("id")->on("routes")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("place_id")->references("id")->on("places")->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer("number");
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
        Schema::dropIfExists('route_place');
    }
}
