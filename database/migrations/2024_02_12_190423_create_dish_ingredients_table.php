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
        Schema::create('dish_ingredients', function (Blueprint $table) {
            $table->id('dish_ingredients_id');
            $table->string('quantity');

            $table->unsignedBigInteger('dish_id');
            $table->foreign('dish_id')->references('dish_id')->on('dishes')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('ingredient_id')->on('ingredients')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dish_ingredients');
    }
};
