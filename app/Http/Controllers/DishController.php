<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DishController extends Controller
{
    //
    function index(){
        return view('dishes');
    }
}
