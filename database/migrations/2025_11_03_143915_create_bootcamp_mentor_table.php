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
        Schema::create('bootcamp_mentor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bootcamp_id')->constrained()->onDelete('cascade');
            $table->foreignId('mentor_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['bootcamp_id', 'mentor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bootcamp_mentor');
    }
};
