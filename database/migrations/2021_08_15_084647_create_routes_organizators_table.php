<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesOrganizatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes_organizators', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("route_id")->references("id")->on("routes")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("organizator_id")->references("id")->on("organizators")->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('routes_organizators');
    }
}
