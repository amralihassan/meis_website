<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('arGrade');
            $table->string('enGrade');
            $table->string('arGradeParent');
            $table->string('enGradeParent');
            $table->string('fromAgeYears');
            $table->string('fromAgemonth');
            $table->string('toAgeYears');
            $table->string('toAgeMonth');
            $table->string('sort');
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
        Schema::dropIfExists('grades');
    }
}
