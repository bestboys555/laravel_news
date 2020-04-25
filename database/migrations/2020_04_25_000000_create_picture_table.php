<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePictureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_thumb');
            $table->string('title')->nullable();
            $table->string('folder');
            $table->string('table_name');
            $table->integer('ref_table_id')->nullable();
            $table->enum('is_cover', ['0', '1'])->default('0');
            $table->integer('section_order')->nullable();
            $table->string('tmp_key')->nullable();
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
        Schema::dropIfExists('picture');
    }
}
