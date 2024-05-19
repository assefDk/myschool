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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id('Subject_id');
            $table->string('sub_name');
            $table->integer('max')->default(0);
            $table->integer('min')->default(0);

            $table->foreignId('ClassId')->references('ClassId')->on('the_classes');
            

            $table->timestamps();
        });
    }
    // $table->foreignId('MajorId')->references('MajorId')->on('majors');
    // $table->string('class');
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
