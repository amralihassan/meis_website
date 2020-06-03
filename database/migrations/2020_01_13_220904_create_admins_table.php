<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('Amr');
            $table->string('mobile')->nullable();
            $table->string('job')->nullable();
            $table->string('preferredLanguage')->default('en');
            $table->enum('status',['enable','disable'])->default('enable');
            $table->string('email')->unique()->default('admin@domain.com');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(bcrypt('123'));
            $table->integer('adminGroupId')->nullable();
            $table->string('imageProfile')->nullable()->default('https://via.placeholder.com/150');
            $table->string('skin')->default('no-skin');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('admins');
    }
}
