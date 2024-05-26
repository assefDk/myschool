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
        Schema::create('homework', function (Blueprint $table) {
            $table->id('IdHomework');
            $table->string('creator');
            $table->string('file');
            $table->string('subject');
            $table->date('startHomework');
            $table->date('endHomework');
            $table->foreignId('idS')->references('idS')->on('subjects');


            
            $table->timestamps();
        });
        // $table->string('homeworkName');
    }
    
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework');
    }
};
