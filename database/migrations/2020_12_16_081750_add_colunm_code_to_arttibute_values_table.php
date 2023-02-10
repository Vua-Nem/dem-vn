<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunmCodeToArttibuteValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->string("code")->after("attribute_id");
            $table->index("code", "idx_code");
            $table->unique("code", "unix_code");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->dropColumn("code");
        });
    }
}
