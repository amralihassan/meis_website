<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistroysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section');            
            $table->text('history');  
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('admins');  
            $table->string('tableName');
            $table->string('idCode');
            $table->enum('crud',['View','Insert','Update','Delete','Import']);                      
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
        Schema::dropIfExists('historys');
    }
}
