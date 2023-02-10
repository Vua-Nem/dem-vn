<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("sku", 30);
            $table->string("name");
            $table->string("slug");
            $table->integer("price");
            $table->integer("compare_price");
            $table->tinyInteger("status");
            $table->string("description", 1000);
            $table->string("default_img", 250);
            $table->timestamps();

            $table->unique("slug");
            $table->unique("sku");
            $table->index("sku", "idx_sku");
            $table->index("slug", "idx_slug");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
