<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('studentId');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phone');
            $table->string('adress');
            $table->string('email')->unique();
            $table->date('birthdate');
            $table->string('fathernName');
            $table->string('motherName');
            $table->enum('gender',['male','feminine']);



            //FK
            $table->foreignId('MajorId')->references('MajorId')->on('majors');
            $table->foreignId('ClassId')->references('ClassId')->on('the_classes');
            $table->foreignId('DivisionId')->references('DivisionId')->on('divisions');

            
            $table->rememberToken();
            $table->timestamps();
        });
            // $table->foreignId('division_id')->references('division_id')->on('divisions');
            // $table->foreignId('student_accounts')->references('user_id')->on('student_accounts');

            // $table->string('ClassName'); 
            // $table->foreign('ClassName')->references('ClassName')->on('the_classes');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};


