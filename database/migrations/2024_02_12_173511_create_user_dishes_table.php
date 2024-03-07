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
        Schema::create('user_dishes', function (Blueprint $table) {
            $table->id('user_dish_id');
            $table->string('user_dish_name');
            $table->string('calories');
            $table->string('proteins');
            $table->string('carbohydrates');
            $table->string('fats');
            $table->integer('quantity');

            $table->unsignedBigInteger('user_recipe_id');
            $table->foreign('user_recipe_id')->references('user_recipe_id')->on('user_recipes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_dishes');
    }
};
