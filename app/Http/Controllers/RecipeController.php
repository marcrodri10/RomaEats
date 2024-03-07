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
        $recipes = Recipe::where('user_id', Auth::user()->id)->get();
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

            Recipe::create($recipeData);
            $recipeId = Recipe::where('user_recipe_name', $request->recipe_name)
            ->get()[0]->user_recipe_id;

            $recipeStepData = [];
            foreach($request->all() as $key => $value){
                if(strpos($key, 'recipe_step_') !== false){
                    $recipeStepData[] = $value;
                }
            }

            foreach($recipeStepData as $step){
                $recipeStep = [
                    'recipe_step_description' => $step,
                    'user_recipe_id' => $recipeId,
                ];
                RecipeStep::create($recipeStep);
            }

            return Redirect::route('recipe.index')->with('product_add', 'added');;
        }
        catch(\Exception $e){
            return Redirect::route('recipe.index')->with('error', $e->getMessage());;
        }
    }

    function showRecipe(Request $request){
        $id = $request->route('id');
        $recipe = Recipe::find($id);
        $steps = RecipeStep::where('user_recipe_id', $id)->get();
        return view('recipe-info', ['recipe' => $recipe, 'steps' => $steps]);
    }
}
