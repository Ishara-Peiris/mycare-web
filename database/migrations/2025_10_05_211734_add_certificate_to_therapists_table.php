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
            // Add a column to store the path to the certificate file
            $table->string('certificate_path')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('therapists', function (Blueprint $table) {
            // Drop the column if rolling back the migration
            $table->dropColumn('certificate_path');
        });
    }
};
