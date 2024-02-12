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
        Schema::create('user_product_dish', function (Blueprint $table) {
            $table->id('user_product_dish');
            $table->string('quantity');

            $table->unsignedBigInteger('user_product_id');
            $table->foreign('user_product_id')->references('user_product_id')->on('user_products')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('user_product_dish');
    }
};
