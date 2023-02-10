<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusOpenTimeSmileRetailerAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('smile_retailer_address', function (Blueprint $table) {
			$table->tinyInteger("status")
				->after("district_id")
				->default(1);
			$table->string("opening_time")
				->after("status")
				->default('8h30 - 21h');

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('smile_retailer_address', function (Blueprint $table) {
			$table->dropColumn("status");
			$table->dropColumn("opening_time");
		});
    }
}
