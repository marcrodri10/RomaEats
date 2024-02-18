<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    //
    function index(){
        $dishes = Dish::all();
        return view('dishes', ['dishes' => $dishes]);
    }
}
