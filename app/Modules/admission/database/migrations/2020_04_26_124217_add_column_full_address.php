<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFullAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onlineRegisters', function (Blueprint $table) {
            $table->string('fatherBlockNo',5)->nullable();
            $table->string('fatherStreetName')->nullable();
            $table->string('fatherArea')->nullable();
            $table->string('fatherGovernorate')->nullable();
            $table->string('motherBlockNo',5)->nullable();
            $table->string('motherStreetName')->nullable();
            $table->string('motherArea')->nullable();
            $table->string('motherGovernorate')->nullable();
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
            $table->dropColumn('fatherBlockNo');
            $table->dropColumn('fatherStreetName');
            $table->dropColumn('fatherArea');
            $table->dropColumn('fatherGovernorate');
            $table->dropColumn('motherBlockNo');
            $table->dropColumn('motherStreetName');
            $table->dropColumn('motherArea');
            $table->dropColumn('motherGovernorate');
        });
    }
}
