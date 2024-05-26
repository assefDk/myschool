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
        Schema::create('divisions_teachers', function (Blueprint $table) {
            $table->id('div_tea_id');

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
        Schema::dropIfExists('divisions_teachers');
    }
};
