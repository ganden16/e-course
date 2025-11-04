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
        Schema::create('module_bootcamps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bootcamp_id')->constrained()->onDelete('cascade');
            $table->integer('week_number');
            $table->string('module');
            $table->text('objective');
            $table->text('description')->nullable();
            $table->json('topics')->nullable();
            $table->integer('duration_hours')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['bootcamp_id', 'week_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_bootcamps');
    }
};
