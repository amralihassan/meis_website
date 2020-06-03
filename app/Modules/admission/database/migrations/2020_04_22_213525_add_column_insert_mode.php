<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInsertMode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onlineRegisters', function (Blueprint $table) {
            $table->enum('insertMode',['parent','employee'])->default('employee');
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
            $table->dropColumn('insertMode');
        });
    }
}
