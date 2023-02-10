<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('url', 500)->nullable();
            $table->string('path')->nullable();
            $table->string('title');
            $table->text('comment');
            $table->tinyInteger('slost')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('type')
                ->default('0')
                ->comment('0 homepage');
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
        Schema::dropIfExists('blog_news');
    }
}
