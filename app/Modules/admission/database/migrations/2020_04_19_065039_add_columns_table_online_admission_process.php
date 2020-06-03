<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsTableOnlineAdmissionProcess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onlineAdmissionProcess', function (Blueprint $table) {
            $table->date('installmentDate')->nullable();
            $table->date('lastDueDate')->nullable();
            $table->enum('installmentStatus',['True','False'])->default('False');
            $table->string('defaultInstallmentMsg')->nullable();
            $table->string('installmentAfterResultMsg')->nullable();
            $table->string('installmentAfterSetDateMsg')->nullable();
            $table->string('installmentAfterPaiedMsg')->nullable();
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
            $table->dropColumn(['installmentDate', 'lastDueDate', 'installmentStatus','defaultInstallmentMsg','installmentAfterResultMsg','installmentAfterSetDateMsg','installmentAfterPaiedMsg']);            
        });
    }
}
