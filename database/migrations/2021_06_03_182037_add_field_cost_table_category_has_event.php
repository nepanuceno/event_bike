<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCostTableCategoryHasEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_has_event', function (Blueprint $table) {
            $table->decimal('cost', 2,2)->notnull()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_has_event', function (Blueprint $table) {
            //
        });
    }
}
