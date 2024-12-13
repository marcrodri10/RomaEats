<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_recipe_id';

    protected $table = 'user_recipes';
    protected $fillable = [
        'user_recipe_id',
        'user_recipe_name',
        'user_recipe_description',
        'user_id',
    ];

    public static function getUserRecipes($id)
    {
        return Recipe::where('user_id', $id)->get();
    }
    public static function createRecipe($recipeData)
    {
        return self::create($recipeData);
    }

    public static function createRecipeSteps($request)
    {
        $recipeId = Recipe::where('user_recipe_name', $request->recipe_name)
            ->get()[0]->user_recipe_id;

        $recipeStepData = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'recipe_step_') !== false) {
                $recipeStepData[] = $value;
            }
        }

        foreach ($recipeStepData as $step) {
            $recipeStep = [
                'recipe_step_description' => $step,
                'user_recipe_id' => $recipeId,
            ];
            RecipeStep::create($recipeStep);
        }
    }

    public static function getUserRecipeById($id){
        return self::find($id);
    }
}
