<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnReassessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onlineAdmissionProcess', function (Blueprint $table) {
            $table->date('reAssessmentDate')->nullable();
            $table->enum('reAssessmentMode',['True','False'])->default('False');
            $table->enum('reAssessmentStatus',['True','False'])->default('False');            
            $table->enum('reAssessmentResult',['Accept','Reject','Not Define'])->default('Not Define');
            $table->text('beforeSetReassessmentDate')->nullable();
            $table->text('afterSetReassessmentDate')->nullable();
            $table->text('afterReassessmentDone')->nullable();
            $table->text('reAssessmentRejected')->nullable();
            $table->text('reAssessmentAccepeted')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('onlineAdmissionProcess', function (Blueprint $table) {
            $table->dropColumn(['reAssessmentDate','reAssessmentMode','reAssessmentStatus','reAssessmentResult','beforeSetReassessmentDate','afterSetReassessmentDate','afterReassessmentDone','reAssessmentRejected','reAssessmentAccepeted']);
        });
    }
}
