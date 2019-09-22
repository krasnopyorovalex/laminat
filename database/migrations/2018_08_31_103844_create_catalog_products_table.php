<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_products', static function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('catalog_id');
            $table->string('name', 512);
            $table->string('title', 512);
            $table->string('description', 512)->nullable();
            $table->text('text')->nullable();
            $table->string('alias', 255)->unique();
            $table->string('label', 16)->nullable();
            $table->unsignedMediumInteger('price')->default(0);
            $table->unsignedSmallInteger('pos')->default(0);
            $table->timestamps();

            $table->foreign('catalog_id')->references('id')->on('catalogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_products');
    }
}
