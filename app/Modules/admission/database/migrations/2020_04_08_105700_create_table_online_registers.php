<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOnlineRegisters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlineRegisters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstName','15')->nullable();
            $table->string('middleName','15')->nullable();
            $table->string('lastName','15')->nullable();
            $table->string('familyName','15')->nullable();
            $table->string('firstNameEn','15')->nullable();
            $table->string('middleNameEn','15')->nullable();
            $table->string('lastNameEn','15')->nullable();
            $table->string('familyNameEn','15')->nullable();
            $table->string('fatherIdNumber','15')->nullable();
            $table->string('fatherMobile','15')->nullable();
            $table->string('homePhone','15')->nullable();
            $table->string('fatherFacebookAccount','15')->nullable();
            $table->string('fatherJob','25')->nullable();
            $table->string('fatherQualification','30')->nullable();
            $table->string('fatherEmail','50')->nullable();
            $table->string('fatherNationality','30')->nullable();
            $table->enum('maritalStatus',['Married','Divorced','Separated','Widow'])->default('Married');
            $table->enum('fatherReligion',['Muslim','Christian'])->default('Muslim');
            $table->string('fatherAddress','100')->nullable();
            $table->string('motherName','75')->nullable();
            $table->string('motherFacebookAccount','75')->nullable();
            $table->string('motherIdNumber','15')->nullable();
            $table->string('motherMobile','15')->nullable();
            $table->string('motherJob','25')->nullable();
            $table->string('motherQualification','30')->nullable();
            $table->string('motherEmail','50')->nullable();
            $table->string('motherNationality','30')->nullable();
            $table->enum('motherReligion',['Muslim','Christian'])->default('Muslim');
            $table->string('motherAddress','100')->nullable();
            $table->string('applicantName','15')->nullable();
            $table->string('applicantNameEn','15')->nullable();
            $table->enum('applicantGender',['Male','Female'])->default('Male');
            $table->enum('nativeLanguage',['Arabic','English','Chinese','Hindi','Spanish','Russian','Portuguese','Bengali','French','German','Italian','Other'])->default('Arabic');
            $table->enum('secondLanguage',['Spanish','French','German','Italian'])->default('French');
            $table->string('code')->unique();
            $table->date('dob')->nullable();
            $table->integer('yy');
            $table->integer('mm');
            $table->integer('dd');
            $table->string('applicantNationality','30')->nullable();
            $table->enum('applicantReligion',['Muslim','Christian'])->default('Muslim');       
            $table->unsignedBigInteger('devisionId')->nullable();
            $table->unsignedBigInteger('nextGradeId')->nullable();
            $table->foreign('nextGradeId')->references('id')->on('grades');              
            $table->unsignedBigInteger('nextAcademicYearId');
            $table->foreign('nextAcademicYearId')->references('id')->on('academicyears');  
            $table->string('meetRepresentative')->nullable();
            $table->enum('AcceptanceAcknowledgment',['True','False'])->default('False');
            $table->enum('recognition', ['facebook', 'parent','show','friend','street']);
            $table->enum('educationRights', ['father', 'mother']); //new
            $table->enum('registrationType',['new','transfer','returning','arrival'])->default('new');
            $table->string('fromSchool')->nullable();
            $table->text('transferReason')->nullable(); //new  
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
        Schema::dropIfExists('onlineRegisters');
    }
}
