<?php

namespace App\Http\Controllers;

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
    // Por aquí también
}
