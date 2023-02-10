<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductShortDescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_short_descriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('name');
            $table->timestamps();

            $table->index("product_id", "idx_product_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_short_descriptions');
    }
}
