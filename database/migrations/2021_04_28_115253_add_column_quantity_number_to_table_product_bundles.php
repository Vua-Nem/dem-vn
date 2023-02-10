<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnQuantityNumberToTableProductBundles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_bundles', function (Blueprint $table) {
			$table->integer("quantity_number")->after("product_attach_price");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_bundles', function (Blueprint $table) {
			$table->dropColumn("quantity_number");
        });
    }
}
