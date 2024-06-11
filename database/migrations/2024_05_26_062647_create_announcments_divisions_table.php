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
        Schema::create('announcments_divisions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('IdAnnouncment')->references('IdAnnouncment')->on('announcments');
            $table->foreignId('DivisionId')->references('DivisionId')->on('divisions');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcments_divisions');
    }
};
