<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class OrderController extends Controller
{
    //
    function index(){
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('user-orders', ['orders' => $orders]);
    }

    function orders(){
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')->get();
        return view('all-orders', ['orders' => $orders]);
    }
    function showOrder(Request $request){
        $id = $request->route('id');
        $order = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->where('order_id', $id)->get()[0];
        return view('order-info', ['order' => $order]);
    }

    function getAllOrderAddress(){
        $addresses = Order::join('users', 'orders.user_id', '=', 'users.id')->get();

        echo json_encode(['message' => $addresses]);
    }

    function showOrderMap(Request $request){
        $id = $request->route('id');
        $order = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->where('order_id', $id)
        ->get();
        //Session::put('order_id', $id);
        return view('order-map', ['order' => $order]);
    }

    function showDeliveryRoute(){

        return view('delivery-route');
    }

    function getRouteData(Request $request){
        $requestData = $request->json()->all();

        foreach($requestData as $data){
            dump($data);
            Order::where('order_dish_code', $requestData['code'])
            ->update(['order_status' => 'Delivery']);
        }
    }
    function updateUserOrder(Request $request){
        $requestData = $request->json()->all();
        foreach($requestData as $data){
            Order::where('order_dish_code', $data)
            ->update(['order_status' => 'Delivery']);
        }


        return response()->json(['message' => 'Updated']);
    }

}
