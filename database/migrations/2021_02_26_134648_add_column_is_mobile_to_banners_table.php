<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsMobileToBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banner_homepage', function (Blueprint $table) {
            $table->tinyInteger("is_mobile")->default(1)->after("type");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banner_homepage', function (Blueprint $table) {
            $table->dropColumn("is_mobile");
        });
    }
}
