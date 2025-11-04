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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('product_category_id')->constrained()->onDelete('cascade');
            $table->string('instructor');
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2);
            $table->string('image');
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('students')->default(0);
            $table->string('duration');
            $table->string('level');
            $table->text('description');
            $table->json('features')->nullable();
            $table->json('curriculum')->nullable();
            $table->json('requirements')->nullable();
            $table->json('what_you_will_build')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
