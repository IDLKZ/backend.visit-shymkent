<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("place_id")->nullable()->references("id")->on("places")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("event_id")->nullable()->references("id")->on("events")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("route_id")->nullable()->references("id")->on("routes")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("blog_id")->nullable()->references("id")->on("blogs")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("news_id")->nullable()->references("id")->on("news")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("shop_id")->nullable()->references("id")->on("shops")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("organizator_id")->nullable()->references("id")->on("organizators")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("souvenir_id")->nullable()->references("id")->on("souvenirs")->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('savings');
    }
}
