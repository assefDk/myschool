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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('idT');
            $table->string('username');
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone');
            $table->string('address');
            $table->string('email')->unique();
            $table->date('birthdate');
            $table->string('fathername');
            $table->string('mothername');
            $table->enum('gender',['female','male']);




            //FK
            // $table->foreignId('MajorId')->references('MajorId')->on('majors');
            // $table->foreignId('ClassId')->references('ClassId')->on('the_classes');
            // $table->foreignId('DivisionId')->references('DivisionId')->on('divisions');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
