<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicyearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academicyears', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academicYear');
            $table->date('startFrom');
            $table->date('endFrom');
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
        Schema::dropIfExists('academicyears');
    }
}
