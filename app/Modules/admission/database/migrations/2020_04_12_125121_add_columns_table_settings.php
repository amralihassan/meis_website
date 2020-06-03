<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsTableSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->time('openTime')->nullable();
            $table->time('closeTime')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('contact');
            $table->dropColumn('openTime');
            $table->dropColumn('closeTime');
            $table->dropColumn('facebook');
            $table->dropColumn('youtube');            
        });
    }
}
