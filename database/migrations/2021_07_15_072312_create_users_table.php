<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->foreignId("role_id")->references("id")->on("roles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("name");
            $table->string("email")->unique();
            $table->string("phone")->unique();
            $table->string("password");
            $table->string("image")->nullable();
            $table->text("description")->nullable();
            $table->integer("status")->default(1);
            $table->integer("verified")->default(0);
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
        Schema::dropIfExists('users');
    }
}
