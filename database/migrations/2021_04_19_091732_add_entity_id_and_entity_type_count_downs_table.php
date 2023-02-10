<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEntityIdAndEntityTypeCountDownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('count_downs', function (Blueprint $table) {
			$table->integer("entity_id")->after("id");
			$table->tinyInteger("entity_type");

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('count_downs', function (Blueprint $table) {
			$table->dropColumn("entity_id");
			$table->dropColumn("entity_type");
		});
    }
}
