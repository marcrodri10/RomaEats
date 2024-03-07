<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    use HasFactory;
    protected $primaryKey = 'recipe_steps_id';

    protected $table = 'user_recipes_steps';
    protected $fillable = [
        'recipe_step_description',
        'user_recipe_id',
    ];
}
