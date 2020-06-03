<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAddressColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onlineRegisters', function (Blueprint $table) {
            $table->dropColumn('fatherAddress');
            $table->dropColumn('motherAddress');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('onlineRegisters', function (Blueprint $table) {
            //
        });
    }
}
