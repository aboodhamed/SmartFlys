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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number')->unique();
            $table->foreignId('airline_id')->constrained()->onDelete('cascade');
            $table->string('origin');
            $table->string('destination');
            $table->date('flight_date');
            $table->time('flight_time');
            $table->decimal('price', 8, 2);
            $table->integer('capacity');
            $table->string('aircraft_type');
            $table->string('status')->default('Available');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};