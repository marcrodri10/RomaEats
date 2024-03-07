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
            if(Auth::user()->role_id == 1){
                $dishes = Dish::select('*')
                ->take(4)
                ->get();
                return view('index', ['dishes' => $dishes]);
            }
            else return view('employee-index');
        }
        else {
            $dishes = Dish::select('*')
                ->take(4)
                ->get();
            return view('index', ['dishes' => $dishes]);
        }


    }
}
