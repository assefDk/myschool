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
        Schema::create('divisions', function (Blueprint $table) {
            $table->id('DivisionId');
            $table->string('WeeklySchedule');
            $table->enum('Numberdvs',[1,2,3,4,5,6,7,8,9,10]);
            $table->foreignId('ClassId')->references('ClassId')->on('the_classes');
            // $table->foreign('homework_id')->references('homework_id')->on('homework');
            // $table->foreign('teacher_id')->references('teacher_id')->on('teacher');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
