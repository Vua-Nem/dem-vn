<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PayooCallLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payoo_call_logs', function (Blueprint $table) {
			$table->id();
			$table->integer("order_id");
			$table->integer("transaction_id");
			$table->string("bank_code");
			$table->text("data");
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
        Schema::dropIfExists('payoo_call_logs');
    }
}
