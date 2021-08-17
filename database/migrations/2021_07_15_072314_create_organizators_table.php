<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizators', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("role_id")->references("id")->on("roles")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("title_ru");
            $table->string("title_kz");
            $table->string("title_en");
            $table->text("description_ru");
            $table->text("description_kz");
            $table->text("description_en");
            $table->text("education_ru")->nullable();
            $table->text("education_kz")->nullable();
            $table->text("education_en")->nullable();
            $table->text("languages")->nullable();
            $table->string("image")->nullable();
            $table->string("alias");
            $table->string("eventum")->nullable();
            $table->json("phone")->nullable();
            $table->json("social_networks")->nullable();
            $table->json("sites")->nullable();
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
        Schema::dropIfExists('organizators');
    }
}
