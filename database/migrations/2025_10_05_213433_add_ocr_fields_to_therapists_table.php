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
        Schema::table('therapists', function (Blueprint $table) {
            // Stores the extracted text (first 1000 characters) for admin review
            $table->text('ocr_summary')->nullable()->after('certificate_path'); 
            // Flag if the OCR detected a keyword (License, Certificate, etc.)
            $table->boolean('is_keyword_found')->default(false)->after('ocr_summary'); 
        });
    }

    public function down(): void
    {
        Schema::table('therapists', function (Blueprint $table) {
            $table->dropColumn(['ocr_summary', 'is_keyword_found']);
        });
    }
};
