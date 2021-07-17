<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("place_id")->nullable()->references("id")->on("places")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("type_id")->references("id")->on("event_types")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("title_ru");
            $table->string("title_kz");
            $table->string("title_en");
            $table->text("description_ru");
            $table->text("description_kz");
            $table->text("description_en");
            $table->string("alias");
            $table->string("eventum")->nullable();
            $table->json("phone")->nullable();
            $table->json("social_networks")->nullable();
            $table->json("sites")->nullable();
            $table->string("address")->nullable();
            $table->text("address_link")->nullable();
            $table->string("price")->nullable();
            $table->json("images");
            $table->json("ratings")->nullable();
            $table->integer("status");
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
        Schema::dropIfExists('events');
    }
}
