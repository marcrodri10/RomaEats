<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\UserDish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserDishController extends Controller
{
    //
    function index(){
        $userDishes = UserDish::where('user_id', Auth::user()->id)->get();
        $recipes = Recipe::where('user_id', Auth::user()->id)->get();
        return view('user-dishes', ['userDishes' => $userDishes, 'recipes' => $recipes]);
    }

    function saveUserDish(Request $request){
        try{
            $userDishData = [
                'user_dish_name' => $request->dish_name,
                'calories' => $request->calories,
                'proteins' => $request->proteins,
                'carbohydrates' => $request->carbohydrates,
                'fats' => $request->fats,
                'quantity' => $request->quantity,
                'user_recipe_id' => $request->recipes,
                'user_id' => Auth::user()->id,
            ];

            UserDish::create($userDishData);
            return Redirect::route('mydishes.index')->with('product_add', 'added');
        }
        catch(\Exception $e){
            return Redirect::route('mydishes.index')->with('error', $e->getMessage());
        }

    }
    function showUserDish(Request $request){
        $id = $request->route('id');
        $dish = UserDish::find($id);

        return view('user-dish-info', ['dish' => $dish]);
    }
}
