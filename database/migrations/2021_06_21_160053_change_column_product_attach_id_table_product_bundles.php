<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnProductAttachIdTableProductBundles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('product_bundles', function (Blueprint $table) {
			$table->string("product_attach_id",50)->change();
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
			$table->integer("product_attach_id")->change();
		});
    }
}
