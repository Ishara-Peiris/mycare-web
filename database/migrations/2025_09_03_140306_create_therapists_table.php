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
        Schema::create('therapists', function (Blueprint $table) {
               $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('specialization');
    $table->integer('experience_years');
    $table->decimal('consultation_fee', 8, 2);
    $table->string('languages')->nullable(); // comma-separated or JSON
    $table->float('rating')->default(0);
    $table->boolean('is_verified')->default(false);
    $table->json('availability')->nullable();
    $table->text('description')->nullable(); // 
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapists');
    }
};
