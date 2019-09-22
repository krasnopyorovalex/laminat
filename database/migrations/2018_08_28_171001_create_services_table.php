<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('name', 512);
            $table->string('title', 512);
            $table->string('description', 512);
            $table->text('text')->nullable();
            $table->string('alias', 64)->unique();
            $table->enum('is_published',[0,1])->default(1);
            $table->unsignedTinyInteger('pos')->default(0);

            $table->foreign('parent_id')->references('id')->on('services')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
