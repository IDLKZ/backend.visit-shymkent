<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventumEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventum_events', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("last_updated")->nullable();
            $table->string("current_updated")->nullable();
            $table->foreignId("cron_id")->nullable()->references("id")->on("crons")->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("status")->default(0);
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
        Schema::dropIfExists('eventum_events');
    }
}
