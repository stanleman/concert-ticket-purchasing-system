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
        Schema::create('concerts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('artist');
            $table->longText('description');
            $table->longText('image');
            $table->string('date');
            $table->string('time');
            $table->unsignedInteger('organiser_id'); // Ensure it matches the 'id' column type in 'users' table
            $table->foreign('organiser_id')->references('id')->on('organisers');
            $table->unsignedInteger('venue_id'); // Ensure it matches the 'id' column type in 'users' table
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concerts');
    }
};
