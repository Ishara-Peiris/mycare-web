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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // uploader (Admin/Therapist)
    $table->string('title');
    $table->text('description')->nullable();
    $table->enum('type', ['article','video','pdf']); 
    $table->string('file_url')->nullable();   // Cloudinary link
    $table->string('public_id')->nullable();  // Cloudinary ID for delete
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
