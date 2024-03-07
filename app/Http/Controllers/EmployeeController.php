<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    function orders(){
        $orders = Order::all();
        return view('all-orders', ['orders' => $orders]);
    }
}
