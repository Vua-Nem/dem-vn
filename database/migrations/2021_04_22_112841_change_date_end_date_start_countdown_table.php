<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDateEndDateStartCountdownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('count_downs', function (Blueprint $table) {
			$table->string("start_date")->change();
			$table->string("end_date")->change();
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
			$table->string("start_date")->change();
			$table->string("end_date")->change();;
		});
    }
}
