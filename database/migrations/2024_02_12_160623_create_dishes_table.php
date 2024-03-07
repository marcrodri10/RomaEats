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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id('dish_id');
            $table->string('dish_name');
            $table->string('dish_description');
            $table->float('dish_price');
            $table->integer('calories');
            $table->integer('proteins');
            $table->integer('carbohydrates');
            $table->integer('fats');
            $table->integer('quantity');
            $table->string('dish_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
