<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->text('detail');
            $table->integer('cat_id')->unsigned();
            $table->timestamps();

            $table->foreign('cat_id')->references('id')->on('news_category');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
