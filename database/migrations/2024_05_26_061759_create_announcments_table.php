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
        Schema::create('announcments', function (Blueprint $table) {
            $table->id('IdAnnouncment');


            $table->string('title');
            $table->string('creator');
            $table->string('content');
            $table->date('Date_Created');
            $table->date('Expiry_date');
            $table->enum('status',['d','sud','se','t','m','sstm'])->default('d');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcments');
    }
};
