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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            
            $table->double('mid')->default(0);
            $table->double('in_class')->default(0);
            $table->double('homework')->default(0);
            $table->double('final')->default(0);
            $table->foreignId('student_id')->references('studentId')->on('students');
            $table->foreignId('sub_tea_id')->references('sub_tea_id')->on('subject_teacher');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
