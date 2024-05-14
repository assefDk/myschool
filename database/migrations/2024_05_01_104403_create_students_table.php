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




            // $table->string('majorName'); 
            // $table->foreign('majorName')->references('name')->on('majors');

            // $table->enum('ClassName',['ClassOne','ClassTow','ClassThree','ClassFour','Classfive','ClassSix','ClassSeven','ClassEight','ClassNine','ClassTen','ClassTwelfth','ClassThirteenth']);
            // $table->foreignId('ClassName')->references('ClassName')->on('the_classes');


            // $table->foreignId('name')->references('name')->on('majors');
            // $table->foreignId('ClassName')->references('ClassName')->on('the_classes');
            // $table->foreignId('Numberdvs')->references('Numberdvs')->on('divisions');

            
            $table->rememberToken();
            $table->timestamps();
        });
            // $table->foreignId('division_id')->references('division_id')->on('divisions');
            // $table->foreignId('student_accounts')->references('user_id')->on('student_accounts');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

// Schema::create('students', function (Blueprint $table) {
//     // Other columns...
//     $table->unsignedBigInteger('name'); // Foreign key column
//     // Other columns...

//     // Foreign key constraint
//     $table->foreign('name')
//         ->references('name') // Referenced column
//         ->on('majors') // Referenced table
//         ->onDelete('cascade'); // Optional: Define the action on deletion
// });
