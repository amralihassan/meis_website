<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicationCodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('applicationCode');
            $table->unsignedBigInteger('onlineId')->unique();
            $table->foreign('onlineId')->references('id')->on('onlineRegisters');  
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('admins'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicationCodes');
    }
}
