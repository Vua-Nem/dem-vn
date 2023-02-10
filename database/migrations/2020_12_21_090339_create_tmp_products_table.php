<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmpProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_products', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->string("product_parent");
            $table->string("status");
            $table->string("sku", 50)->unique();
            $table->text("content");
            $table->string("category");
            $table->tinyInteger("create_product_status")->default(0);
            $table->tinyInteger("create_variant_status")->default(0);
            $table->tinyInteger("create_vendor_status")->default(0);
            $table->tinyInteger("create_brand_status")->default(0);
            $table->timestamps();

            $table->index("sku", "idx_tmp_products_sku");
            $table->index("create_product_status", "idx_tmp_products_create_product_status");
            $table->index("create_variant_status", "idx_tmp_products_create_variant_status");
            $table->index("create_brand_status", "idx_tmp_products_create_brand_status");
            $table->index("product_id", "idx_tmp_products_product_id");
            $table->index("product_parent", "idx_tmp_products_product_parent");
            $table->index("category", "idx_tmp_products_category");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_products');
    }
}
