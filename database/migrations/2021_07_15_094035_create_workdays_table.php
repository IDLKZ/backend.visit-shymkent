<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workdays', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("place_id")->nullable()->references("id")->on("places")->cascadeOnDelete()->cascadeOnUpdate()->after("id");
            $table->foreignId("event_id")->nullable()->references("id")->on("events")->cascadeOnDelete()->cascadeOnUpdate()->after("id");
            $table->foreignId("point_id")->nullable()->references("id")->on("route_points")->cascadeOnDelete()->cascadeOnUpdate()->after("id");
            $table->foreignId("shop_id")->nullable()->references("id")->on("shops")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("weekday_id")->references("id")->on("weekdays")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("date_start")->nullable();
            $table->string("date_end")->nullable();
            $table->string("time_start")->nullable();
            $table->string("time_end")->nullable();
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
        Schema::dropIfExists('workdays');
    }
}
