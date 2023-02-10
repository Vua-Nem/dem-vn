<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer("parent_id")->nullable()->default(0);
            $table->string("name", 255);
            $table->integer("position")->nullable()->default(0);
            $table->string("url", 500)->nullable();
            $table->string("class_name", 500)->nullable();
            $table->string("id_name", 150)->nullable();
            $table->timestamps();

            $table->index("parent_id", "idx_parent_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
