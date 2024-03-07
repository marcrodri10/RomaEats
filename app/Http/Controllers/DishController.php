<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Dish;

class DishController extends Controller
{
    // Tonto quien lo lea
    function index(){
        $dishes = Dish::orderBy('dish_name', 'ASC')
            ->with('ingredients')
            ->paginate(5);
        return view('dishes', compact('dishes'));
    }

    function showDish(Request $request){
        $id = $request->route('id');

        $dish = Dish::find($id);

        return view('dish-full', ['dish' => $dish]);
    }
}
