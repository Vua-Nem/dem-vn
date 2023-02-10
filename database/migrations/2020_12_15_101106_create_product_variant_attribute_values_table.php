<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->integer("product_variant_id")->default(0);
            $table->integer("attribute_value_id");
            $table->timestamps();

            $table->index("product_id", "idx_product_id");
            $table->index("product_variant_id", "idx_product_variant_id");
            $table->index("attribute_value_id", "idx_attribute_value_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_values');
    }
}
