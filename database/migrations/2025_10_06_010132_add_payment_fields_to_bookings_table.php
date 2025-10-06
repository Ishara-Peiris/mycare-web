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
        Schema::table('bookings', function (Blueprint $table) {
            // 1. Add Payment Fields
            $table->string('payment_method')->nullable()->after('session_time'); // e.g., 'stripe', 'bank_deposit'
            $table->string('transaction_id')->nullable()->after('payment_method'); // Gateway ID or Deposit Reference
            $table->decimal('amount_paid', 8, 2)->nullable()->after('transaction_id'); // Actual amount due/paid
        });

        // 2. Modify the 'status' column to include 'unpaid' and 'failed'
        // Note: Modifying ENUMs often requires a separate DB statement (driver-dependent)
        // We assume MySQL here, which requires DB::statement
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('unpaid', 'pending', 'confirmed', 'completed', 'cancelled', 'failed') DEFAULT 'unpaid'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Revert status type back to original set (or drop and re-add if needed, but risky)
            // For simplicity, we drop the new payment fields.
            $table->dropColumn(['payment_method', 'transaction_id', 'amount_paid']);
        });

        // Revert ENUM status (optional but recommended for a full rollback)
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending'");
    }
};
