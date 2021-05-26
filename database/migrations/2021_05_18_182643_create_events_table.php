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
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('modality_id');

            $table->string('name');
            $table->dateTime('date_event');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('adress');
            $table->string('logo');

            $table->foreign('category_id')->references('id')->on('event_categories');
            $table->foreign('modality_id')->references('id')->on('event_modalities');

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
