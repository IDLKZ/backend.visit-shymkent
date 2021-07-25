<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWorkdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workdays', function (Blueprint $table) {
            $table->foreignId("place_id")->nullable()->references("id")->on("places")->cascadeOnDelete()->cascadeOnUpdate()->after("id");
            $table->foreignId("event_id")->nullable()->references("id")->on("events")->cascadeOnDelete()->cascadeOnUpdate()->after("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workdays', function (Blueprint $table) {
            //
        });
    }
}
