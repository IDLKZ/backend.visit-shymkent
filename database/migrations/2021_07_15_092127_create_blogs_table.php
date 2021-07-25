<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("tag_id")->references("id")->on("tags")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("author_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("title_ru");
            $table->string("title_en");
            $table->string("title_kz");
            $table->text("description_ru");
            $table->text("description_en");
            $table->text("description_kz");
            $table->string("alias");
            $table->string("image")->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
