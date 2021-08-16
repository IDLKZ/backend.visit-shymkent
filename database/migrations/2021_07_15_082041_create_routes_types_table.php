<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes_types', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("route_id")->references("id")->on("routes")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("type_id")->references("id")->on("route_types")->cascadeOnDelete()->cascadeOnDelete();
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
        Schema::dropIfExists('routes_types');
    }
}
