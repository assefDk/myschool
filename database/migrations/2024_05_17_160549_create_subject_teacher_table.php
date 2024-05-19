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
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->id('sub_tea_id');

            $table->foreignId('Subject_id')->references('Subject_id')->on('subjects');
            $table->foreignId('id')->references('teacher_id')->on('teachers');
            
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_teacher');
    }
};
