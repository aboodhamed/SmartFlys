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
        Schema::create('entity_actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('EntityID');
            $table->unsignedBigInteger('ActionID');
            $table->foreign('EntityID')->references('EntityID')->on('entities')->onDelete('cascade');
            $table->foreign('ActionID')->references('ActionID')->on('actions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_actions');
    }
};
