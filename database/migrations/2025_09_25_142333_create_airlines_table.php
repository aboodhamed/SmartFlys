<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlinesTable extends Migration
{
    public function up()
    {
        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->string('founded')->nullable();
            $table->string('headquarters')->nullable();
            $table->integer('fleet_size')->nullable();
            $table->string('destinations')->nullable();
            $table->string('website')->nullable();
            $table->string('flag_url')->nullable();
            $table->string('badge_color')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('airlines');
    }
}