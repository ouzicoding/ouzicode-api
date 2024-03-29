<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * 文章表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false)->default('');
            $table->string('thumb');
            $table->text('digest');
            $table->text('content');
            $table->integer('clicks')->nullable(false)->default(0);
            $table->integer('category_id')->nullable(false)->default(0);
            $table->tinyInteger('is_deleted')->nullable(false)->default(0);
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
        Schema::dropIfExists('articles');
    }
}
