<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumStartHoursCountDownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('count_downs', function (Blueprint $table) {
			$table->integer("start_hour")
				->after("status")
				->nullable();

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('notify_sales', function (Blueprint $table) {
			$table->dropColumn("start_hour");
		});
    }
}
