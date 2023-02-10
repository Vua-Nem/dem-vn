<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBundle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_bundles', function (Blueprint $table) {
            $table->id();
			$table->integer("product_id");
			$table->integer("product_attach_id");
			$table->integer("product_attach_price");
            $table->timestamps();
			$table->index("product_id", "idx_product_bundles_product_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_bundles');
    }
}
