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

            $table->foreignId('idS')->references('idS')->on('subjects');
            $table->foreignId('idT')->references('idT')->on('teachers');
            $table->foreignId('DivisionId')->references('DivisionId')->on('divisions');
            

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
