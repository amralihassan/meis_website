<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTableOnlineRegisterMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('online_register_messages', function (Blueprint $table) {
            $table->integer('allowedDays')->default(14);
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
        Schema::table('online_register_messages', function (Blueprint $table) {
            $table->dropColumn(['allowedDays','defaultInstallmentMsg','installmentAfterResultMsg','installmentAfterSetDateMsg','installmentAfterPaiedMsg']);            
        });
    }
}
