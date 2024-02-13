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
        Schema::create('user_shopping_cart', function (Blueprint $table) {
            $table->id('user_shopping_cart_id');
            $table->string('quantity');
            $table->float('price');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('dish_id');
            $table->foreign('dish_id')->references('dish_id')->on('dishes')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('user_dish_id');
            $table->foreign('user_dish_id')->references('user_dish_id')->on('user_dishes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_shopping_cart');
    }
};
