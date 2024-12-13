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
        $orders = Order::getUserOrders(Auth::user()->id);
        return view('user-orders', ['orders' => $orders]);
    }

    function showOrder(Request $request){
        $id = $request->route('id');
        $order = Order::getOrder($id)->first();
        return view('order-info', ['order' => $order]);
    }

    function getAllOrderAddress(){
        $addresses = Order::join('users', 'orders.user_id', '=', 'users.id')->get();

        echo json_encode(['message' => $addresses]);
    }

    function showOrderMap(Request $request){
        $id = $request->route('id');
        $order = Order::getOrder($id);
        return view('order-map', ['order' => $order]);
    }

    function showDeliveryRoute(){
        return view('delivery-route');
    }

    function getRouteData(Request $request){
        $requestData = $request->json()->all();

        foreach($requestData as $data){
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
