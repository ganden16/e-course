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
        Schema::create('bootcamps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2);
            $table->string('image');
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('students')->default(0);
            $table->string('duration');
            $table->string('level');
            $table->string('schedule');
            $table->date('start_date');
            $table->text('description');
            $table->json('features')->nullable();
            $table->json('curriculum')->nullable();
            $table->json('learning_outcomes')->nullable();
            $table->json('career_support')->nullable();
            $table->json('requirements')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bootcamps');
    }
};
