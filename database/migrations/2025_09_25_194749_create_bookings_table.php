<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Make user_id nullable first
            $table->foreignId('user_id')->nullable()->change();
            
            // Add all the missing columns
            $table->string('first_name')->after('user_id');
            $table->string('last_name')->after('first_name');
            $table->string('email')->after('last_name');
            $table->string('phone', 20)->after('email');
            $table->string('passport_number', 20)->after('phone');
            $table->date('date_of_birth')->after('passport_number');
            $table->string('seat', 10)->after('date_of_birth');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 
                'last_name', 
                'email', 
                'phone', 
                'passport_number', 
                'date_of_birth', 
                'seat'
            ]);
        });
    }
};