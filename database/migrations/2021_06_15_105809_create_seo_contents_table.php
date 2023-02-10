<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_contents', function (Blueprint $table) {
            $table->id();
            $table->integer("entity_id");
            $table->integer("entity_type");
            $table->string('meta_title', 10000)->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_des')->nullable();
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
        Schema::dropIfExists('seo_contents');
    }
}
