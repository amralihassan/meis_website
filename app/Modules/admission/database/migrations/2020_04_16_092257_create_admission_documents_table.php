<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('arabicDocumentName');
            $table->string('englishDocumentName');
            $table->text('notes')->nullable();
            $table->set('registrationType',['new', 'transfer', 'returning', 'arrival']);
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
        Schema::dropIfExists('admission_documents');
    }
}
