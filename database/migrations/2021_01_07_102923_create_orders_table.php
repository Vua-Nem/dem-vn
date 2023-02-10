<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("user_name", 250);
            $table->string("phone_number", 50);
            $table->integer("province_id");
            $table->integer("district_id");
            $table->string("address", 250);
            $table->string("description", 250)->nullable();
            $table->integer("amount");
            $table->integer("real_amount");
            $table->integer("created_by");
            $table->tinyInteger("status");
            $table->tinyInteger("payment_method");
            $table->tinyInteger("payment_status");
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
        Schema::dropIfExists('orders');
    }
}
