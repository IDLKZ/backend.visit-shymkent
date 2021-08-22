<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("place_id")->nullable()->references("id")->on("places")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("event_id")->nullable()->references("id")->on("events")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("route_id")->nullable()->references("id")->on("routes")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("shop_id")->nullable()->references("id")->on("shops")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("souvenir_id")->nullable()->references("id")->on("souvenirs")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("organizator_id")->nullable()->references("id")->on("organizators")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("news_id")->nullable()->references("id")->on("news")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("blog_id")->nullable()->references("id")->on("blogs")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("image")->nullable();
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
        Schema::dropIfExists('galleries');
    }
}
