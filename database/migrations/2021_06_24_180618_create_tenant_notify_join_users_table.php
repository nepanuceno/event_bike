<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantNotifyJoinUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_notify_join_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('requesting_user_id');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('recipient_users');

            $table->foreign('requesting_user_id')->references('id')->on('users');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->foreign('recipient_users')->references('id')->on('users');

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
        Schema::dropIfExists('tenant_notify_join_users');
    }
}
