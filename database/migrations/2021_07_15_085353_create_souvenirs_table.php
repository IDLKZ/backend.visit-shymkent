<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSouvenirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('souvenirs', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("category_id")->nullable()->references("id")->on("souvenir_category")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("shop_id")->references("id")->on("shops")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("title_ru");
            $table->string("title_kz");
            $table->string("title_en");
            $table->string("alias",500);
            $table->text("description_ru");
            $table->text("description_kz");
            $table->text("description_en");
            $table->string("eventum")->nullable();
            $table->string("image")->nullable();
            $table->string("price");
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
        Schema::dropIfExists('souvenirs');
    }
}
