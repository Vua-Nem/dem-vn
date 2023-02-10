<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_products', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->tinyInteger("type")->comment("1 là top sale, 2 là top Hot");
            $table->tinyInteger("group_id")->comment("1 là nệm, 2 là chăn ga gối, 3 là phụ kiện, 4 là giường");
            $table->tinyInteger("status");
            $table->integer("position");
            $table->timestamps();

            $table->index("product_id", "idx_top_products_product_id");
            $table->index("type", "idx_top_products_type");
            $table->index("group_id", "idx_top_products_group_id");
            $table->index("status", "idx_top_products_status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('top_products');
    }
}
