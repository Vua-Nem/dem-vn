<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHompageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_products', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->integer("position");
            $table->integer("group");
            $table->tinyInteger("status");
            $table->timestamps();

            $table->index("product_id", "idx_home_page_products_product_id");
            $table->index("group", "idx_home_page_products_group");
            $table->index("status", "idx_home_page_products_status");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_page_products');
    }
}
