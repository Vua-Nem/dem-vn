<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_vouchers', function (Blueprint $table) {
            $table->id();
            $table->integer("order_id");
            $table->integer("voucher_id");
            $table->integer("voucher_discount_type");
            $table->integer("voucher_discount_value");
            $table->integer("voucher_created_by");
            $table->integer("voucher_start_date");
            $table->integer("voucher_end_date");
            $table->timestamps();

            $table->index("order_id", "idx_order_vouchers_order_id");
            $table->index("voucher_id", "idx_order_vouchers_voucher_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_vouchers');
    }
}
