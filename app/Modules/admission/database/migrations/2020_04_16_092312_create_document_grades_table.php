<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('documentId');
            $table->foreign('documentId')->references('id')->on('admission_documents'); 
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
        Schema::dropIfExists('document_grades');
    }
}
