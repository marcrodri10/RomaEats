<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    function orders(){
        $orders = Order::getAllOrders();
        return view('all-orders', ['orders' => $orders]);
    }
}
