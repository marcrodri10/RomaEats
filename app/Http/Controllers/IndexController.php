<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function index()
    {
        if(Auth::check()){
            if(Auth::user()->role_id == 2) return view('employee-index');
        }
        $dishes = Dish::getSomeDishes(4);
        return view('index', ['dishes' => $dishes]);    

    }
}
