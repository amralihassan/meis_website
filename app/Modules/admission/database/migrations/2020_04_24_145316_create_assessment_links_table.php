<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('testName','50');
            $table->string('linkAddress','150');
            $table->string('divisionsId','20');
            $table->enum('status',['Active','In Active'])->default('In Active');
            $table->enum('testType',['assessment','reassessment'])->default('assessment');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('gradeId');
            $table->foreign('gradeId')->references('id')->on('grades');
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
        Schema::dropIfExists('assessment_links');
    }
}
