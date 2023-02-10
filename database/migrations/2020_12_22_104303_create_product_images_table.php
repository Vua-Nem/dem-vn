<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->string("name", 255);
            $table->string("path", 500);
            $table->tinyInteger("type")
                ->default(0)
                ->comment("1 là avatar image");
            $table->timestamps();

            $table->index("product_id", "idx_product_id");
            $table->index("type", "idx_type");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
