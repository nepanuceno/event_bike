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
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('modality_id');

            $table->string('name');
            $table->string('description');
            $table->dateTime('date_event');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('adress');
            $table->string('logo');
            $table->string('event_notice');
            $table->boolean('active')->default(true);

            $table->foreign('modality_id')->references('id')->on('event_modalities');
            $table->foreign('tenant_id')->references('id')->on('tenants');

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

