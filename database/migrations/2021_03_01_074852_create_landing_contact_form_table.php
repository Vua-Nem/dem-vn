<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingContactFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_contact_forms', function (Blueprint $table) {
            $table->id();
            $table->string("full_name", 250);
            $table->string("phone", 50);
            $table->string("email", 150);
            $table->string("source");
            $table->string("note", 1000)->nullable();
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
        Schema::dropIfExists('landing_contact_forms');
    }
}
