<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductFilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_product_filter', static function (Blueprint $table) {
            $table->unsignedInteger('catalog_product_id');
            $table->unsignedInteger('filter_id');
            $table->unsignedInteger('filter_option_id');

            $table->primary(['catalog_product_id', 'filter_id', 'filter_option_id'], 'pmc_catalog_product_filters');

            $table->index(['catalog_product_id']);

            $table->foreign('catalog_product_id')->references('id')->on('catalog_products')->onDelete('cascade');
            $table->foreign('filter_id')->references('id')->on('filters')->onDelete('cascade');
            $table->foreign('filter_option_id')->references('id')->on('filter_options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_product_filter');
    }
}
