<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Product;
use App\Models\RecipeStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RecipeController extends Controller
{
    //
    function index(){
        $recipes = Recipe::getUserRecipes(Auth::user()->id);
        $products = Product::where('user_id', Auth::user()->id)->get();
        return view('recipes', ['recipes' => $recipes, 'products' => $products]);
    }

    function saveRecipe(Request $request){

        try{
            $recipeData = [
                'user_recipe_name' => $request->recipe_name,
                'user_recipe_description' => $request->recipe_description,
                'user_id' => Auth::user()->id,
            ];

            Recipe::createRecipe($recipeData);

            Recipe::createRecipeSteps($request);

            return Redirect::route('recipe.index')->with('product_add', 'added');;
        }
        catch(\Exception $e){
            return Redirect::route('recipe.index')->with('error', $e->getMessage());;
        }
    }

    function showRecipe(Request $request){
        $id = $request->route('id');
        $recipe = Recipe::getUserRecipeById($id);
        $steps = RecipeStep::getUserRecipesSteps($id);
        return view('recipe-info', ['recipe' => $recipe, 'steps' => $steps]);
    }
}
