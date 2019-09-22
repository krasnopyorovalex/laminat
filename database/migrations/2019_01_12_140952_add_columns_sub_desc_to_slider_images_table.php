<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsSubDescToSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slider_images', function (Blueprint $table) {
            $table->string('sub')->after('slider_id')->nullable();
            $table->string('desc', 512)->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slider_images', function (Blueprint $table) {
            $table->dropColumn(['sub','desc']);
        });
    }
}
