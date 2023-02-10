<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoulumnStatusInNotifySaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notify_sales', function (Blueprint $table) {
			$table->tinyInteger("status")
				->after("notify_des")
				->default(1)
				->comment("1 là active, 0 là Disable");

			$table->index("status", "idx_status");
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
			$table->dropColumn("status");
        });
    }
}
