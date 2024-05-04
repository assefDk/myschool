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
        Schema::create('the_classes', function (Blueprint $table) {
            $table->id('ClassId');
            $table->enum('ClassName',['ClassOne','ClassTow','ClassThree','ClassFour','Classfive','ClassSix','ClassSeven','ClassEight','ClassNine','ClassTen','ClassTwelfth','ClassThirteenth']);
            $table->foreignId('MajorId')->references('MajorId')->on('majors');
            $table->timestamps();
        });
        // $table->enum('level',[1,2,3,4,5,6,7,8,9,10,11,12]);
            // $table->enum('TypeClass', ['primary','Thanori','preparatory','professional','womanly','commercial']);
            
            // $table->enum('TypeClass', ['primary','Thanori','preparatory','professional','womanly','commercial']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('the_classes');
    }
};
