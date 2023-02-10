<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->string("name");
            $table->string("slug");
            $table->string("sku",30);
            $table->integer("price");
            $table->integer("compare_price");
            $table->timestamps();

            $table->index("product_id", "idx_product_id");
            $table->unique("sku", "unix_product_variants_sku");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}
