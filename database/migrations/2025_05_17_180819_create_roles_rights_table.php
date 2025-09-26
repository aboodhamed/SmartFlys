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
        Schema::create('rolesrights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('action_id');
            $table->foreign('role_id')->references('RoleID')->on('roles')->onDelete('cascade');
            $table->foreign('entity_id')->references('EntityID')->on('entities')->onDelete('cascade');
            $table->foreign('action_id')->references('ActionID')->on('actions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rolesrights');
    }
};
