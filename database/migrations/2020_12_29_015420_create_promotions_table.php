<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string("title", 250);
            $table->tinyInteger("promotion_type")
                ->comment("1 là khuyên mại cho tất cả sản phẩm, 2 cho category, 3 cho product");

            $table->tinyInteger("discount_type");
            $table->integer("discount_value");
            $table->integer("min_order_amount");
            $table->integer("min_quantity_item");
            $table->integer("start_date");
            $table->integer("end_date");
            $table->integer("status");
            $table->timestamps();

            $table->index("promotion_type", "idx_promotions_promotion_type");
            $table->index("discount_type", "idx_promotions_discount_type");
            $table->index("start_date", "idx_promotions_start_date");
            $table->index("end_date", "idx_promotions_end_date");
            $table->index("status", "idx_promotions_status");
        });

        Schema::create('promotion_objects', function (Blueprint $table) {
            $table->id();
            $table->integer("promotion_id");
            $table->string("object_id");
            $table->timestamps();

            $table->index("promotion_id", "idx_promotion_objects_promotion_id");
            $table->index("object_id", "idx_promotion_objects_object_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('promotion_objects');
    }
}
