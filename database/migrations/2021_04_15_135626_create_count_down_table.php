<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountDownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count_downs', function (Blueprint $table) {
			$table->id();
			$table->string("title", 250);
			$table->string("name", 250);
			$table->integer("start_date");
			$table->integer("end_date");
			$table->integer("status")->default(1);
			$table->integer("created_by");
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('count_downs');
    }
}
