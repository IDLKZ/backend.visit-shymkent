<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("role_id")->references("id")->on("roles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("title_ru");
            $table->string("title_kz");
            $table->string("title_en");
            $table->text("description_ru");
            $table->text("description_kz");
            $table->text("description_en");
            $table->string("alias",500);
            $table->string("image")->nullable();
            $table->string("eventum")->nullable();
            $table->json("phone")->nullable();
            $table->json("social_networks")->nullable();
            $table->json("sites")->nullable();
            $table->string("address")->nullable();
            $table->longText("address_link")->nullable();
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
        Schema::dropIfExists('shops');
    }
}
