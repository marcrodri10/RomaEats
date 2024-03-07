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
        Schema::create('user_recipes_steps', function (Blueprint $table) {
            $table->id('recipe_steps_id');
            $table->string('recipe_step_description');

            $table->unsignedBigInteger('user_recipe_id');
            $table->foreign('user_recipe_id')->references('user_recipe_id')->on('user_recipes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_recipes_steps');
    }
};
