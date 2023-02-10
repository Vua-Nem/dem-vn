<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerHomepageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_homepage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('path');
            $table->string('title');
            $table->tinyInteger('slost');
            $table->tinyInteger('status');
            $table->tinyInteger('type')->default('0')->comment('0 homepage');
            $table->timestamps();

            $table->index("status", "idx_status");
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
        Schema::dropIfExists('banner_homepage');
    }
}
