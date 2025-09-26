<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // First, check if columns exist before adding them
        if (!Schema::hasColumn('bookings', 'first_name')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->string('first_name')->after('user_id');
                $table->string('last_name')->after('first_name');
                $table->string('email')->after('last_name');
                $table->string('phone', 20)->after('email');
                $table->string('passport_number', 20)->after('phone');
                $table->date('date_of_birth')->after('passport_number');
                $table->string('seat', 10)->after('date_of_birth');
            });
        }

        // Also make user_id nullable if it's not already
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Don't drop columns in down() to avoid the same error
        // You can leave this empty or add conditional checks
    }
};