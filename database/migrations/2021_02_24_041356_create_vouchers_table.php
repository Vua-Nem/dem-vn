<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string("title", 250);
            $table->string("code", 50);
            $table->tinyInteger("voucher_type");
            $table->tinyInteger("discount_type");
            $table->integer("discount_value");
            $table->integer("min_order_amount")->default(0);
            $table->integer("min_quantity_item")->default(0);
            $table->integer("start_date");
            $table->integer("end_date");
            $table->integer("status")->default(1);
            $table->integer("created_by");
            $table->timestamps();

            $table->index("voucher_type", "idx_vouchers_voucher_type");
            $table->index("discount_type", "idx_vouchers_discount_type");
            $table->index("start_date", "idx_vouchers_start_date");
            $table->index("end_date", "idx_vouchers_end_date");
            $table->index("status", "idx_vouchers_status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
