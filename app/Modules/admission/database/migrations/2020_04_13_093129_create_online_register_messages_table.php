<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineRegisterMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_register_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('durationParentInterview')->default(29);
            $table->integer('durationAssessmentTest')->default(60);
            $table->set('offDays',['Sunday','Monday','Tueday','Wednesday','Thursday','Friday','Saturday'])->default('Friday');
            $table->text('defaultPaid')->nullable();
            $table->text('paidText')->nullable();
            $table->text('defaultParentInterview')->nullable();
            $table->text('parentInterviewBeforeSetDate')->nullable();
            $table->text('parentInterviewSetDate')->nullable();
            $table->text('parentAfterInterview')->nullable();
            $table->text('parentInterviewRejected')->nullable();
            $table->text('parentInterviewAccepted')->nullable();
            $table->text('defaultOpenAssessment')->nullable();
            $table->text('assessmentBeforeSetDate')->nullable();
            $table->text('assessmentSetDate')->nullable();
            $table->text('afterAssessment')->nullable();
            $table->text('assessmentRejected')->nullable();
            $table->text('assessmentAccepted')->nullable();
            $table->integer('parentInterviewDuration')->default(29);
            $table->integer('assessmentTestDuration')->default(29);
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
        Schema::dropIfExists('online_register_messages');
    }
}
