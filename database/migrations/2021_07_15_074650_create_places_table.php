<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("organizator_id")->references("id")->on("organizators")->cascadeOnDelete()->cascadeOnUpdate();
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
            $table->longText("address_link")->nullable();
            $table->string("price")->nullable();
            $table->string("image")->nullable();
            $table->string("video_ru")->nullable();
            $table->string("video_kz")->nullable();
            $table->string("video_en")->nullable();
            $table->string("audio_ru")->nullable();
            $table->string("audio_kz")->nullable();
            $table->string("audio_en")->nullable();
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
        Schema::dropIfExists('places');
    }
}
