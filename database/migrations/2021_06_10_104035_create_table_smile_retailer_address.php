<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSmileRetailerAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

		Schema::create('smile_retailer_address', function (Blueprint $table) {
			$table->id();
			$table->integer("entity_id")->default(0);
			$table->string('address')->comment('Street Address');
			$table->string('slug')->nullable();
			$table->string('name')->nullable();
			$table->string('postcode')->comment('Zip/Postal Code');
			$table->string('latitude');
			$table->string('longitude');
			$table->string('phone_store')->nullable();
			$table->string('extension_number')->comment('số máy lẻ')->nullable();
			$table->integer('province_id')->unsigned()->nullable();
			$table->integer('district_id')->unsigned()->nullable();

			$table->timestamps();

			$table->index("province_id", "idx_province_id_smile_retailer_address");
			$table->index("district_id", "idx_district_id_smile_retailer_address");
			$table->index("slug", "idx_retailer_slug");
			$table->unique("slug", "idx_unix_retailer_slug");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smile_retailer_address');
    }
}
