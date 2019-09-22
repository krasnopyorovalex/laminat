<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIsPublishedToGuestbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guestbooks', function (Blueprint $table) {
            $table->enum('is_published',[0,1])->default(0)->after('pos');
            $table->dropColumn(['pos']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guestbooks', function (Blueprint $table) {
            $table->dropColumn(['is_published']);
            $table->unsignedSmallInteger('pos')->default(0)->after('text');
        });
    }
}
