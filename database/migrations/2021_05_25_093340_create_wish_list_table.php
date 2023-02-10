<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('wish_lists', function (Blueprint $table) {
			$table->id();
			$table->string("phone_number", 50);
			$table->string("email", 50)->nullable();
			$table->string("full_name", 50)->nullable();
			$table->integer("province_id")->nullable();
			$table->integer("district_id")->nullable();
			$table->string("address", 250)->nullable();
			$table->text("oder_item", 250)->nullable();
			$table->tinyInteger("status_telegram")->default(1);
			$table->integer("time_send_telegram")->nullable();
			$table->timestamps();

			$table->index("phone_number", "idx_phone_number");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('wish_lists');
    }
}
