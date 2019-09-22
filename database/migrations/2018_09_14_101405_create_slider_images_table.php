<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('slider_id');
            $table->string('name', 255)->nullable();
            $table->string('link', 127)->nullable();
            $table->string('alt', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->char('basename', 40);
            $table->string('ext', 5);
            $table->enum('is_published', [0,1])->default(1);
            $table->unsignedSmallInteger('pos')->default(0);

            $table->index(['slider_id']);
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_images');
    }
}
