<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('name', 255);
            $table->string('link', 127);
            $table->unsignedTinyInteger('pos')->default(0);

            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('menu_items')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
