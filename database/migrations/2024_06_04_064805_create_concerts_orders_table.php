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
        Schema::create('concerts_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('concert_id'); // Ensure it matches the 'id' column type in 'users' table
            $table->foreign('concert_id')->references('id')->on('concerts');
            $table->unsignedInteger('order_id'); // Ensure it matches the 'id' column type in 'users' table
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedInteger('seat_id'); // Ensure it matches the 'id' column type in 'users' table
            $table->foreign('seat_id')->references('id')->on('seats');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concerts_orders');
    }
};
