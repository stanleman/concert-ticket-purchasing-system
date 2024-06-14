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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('concert_id'); 
            $table->foreign('concert_id')->references('id')->on('concerts')->onDelete('cascade');
            $table->unsignedInteger('seat_id'); 
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->date('purchased_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
