<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineAdmissinProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlineAdmissionProcess', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('paid',['True','False'])->default('False');
            $table->enum('receviedCode',['True','False'])->default('False');
            $table->enum('parentInterview',['Yes','No'])->default('No');
            $table->enum('acceptInterview',['Accept','Reject','Not Define'])->default('Not Define');
            $table->enum('openAssessment',['Yes','No'])->default('No');
            $table->enum('assessmentResult',['Accept','Reject','Not Define'])->default('Not Define');
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
            $table->datetime('parentsInterviewDate')->nullable();
            $table->datetime('assessmentTestDate')->nullable();
            $table->unsignedBigInteger('onlineId');
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
        Schema::dropIfExists('onlineAdmissionProcess');
    }
}
