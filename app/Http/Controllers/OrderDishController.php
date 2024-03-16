<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\OrderDish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderDishController extends Controller
{

    //
    function index(){
        $userOrder = OrderDish::select('order_dish.*')
            ->where('order_dish_code', session('order_dish_code'))
            ->selectRaw('order_dish.quantity as user_quantity')
            ->get();
        $data = [];
        foreach($userOrder as $order){
            if($order->dish_id != null){
                $dishOrder = OrderDish::join('dishes', 'order_dish.dish_id', '=', 'dishes.dish_id')
                    ->select('order_dish.*', 'dishes.*')
                    ->where('order_dish_id', $order->order_dish_id)
                    ->selectRaw('order_dish.quantity as user_quantity');
                $data[] = $dishOrder->get();
            }
            else if($order->product_id != null){
                $productOrder = OrderDish::join('user_products', 'order_dish.product_id', '=', 'user_products.user_product_id')
                    ->select('order_dish.*', 'user_products.*')
                    ->where('order_dish_id', $order->order_dish_id)
                    ->selectRaw('order_dish.quantity as user_quantity');
                $data[] = $productOrder->get();
            }

        }

        $userCards = Card::where('user_id', Auth::user()->id)
        ->where('save_card', 1)
        ->get();

        return view('order_dish', ['userOrder' => $data, 'userCards' => $userCards]);
    }
    function addOrder(Request $request){
        try{
            if(Auth::check()){
                $requestData = $request->json()->all();

                $dbData = [];
                $userId = Auth::user()->id;
                $amount = 0;
                $currentDate = new \DateTime();

                $orderDishCode = 'O'.$currentDate->format('YmdHis').$userId;

                Session::put('order_dish_code', $orderDishCode);

                foreach($requestData as $data => $order){
                    if(strpos($data, 'dish') !== false){
                        $dbData = [
                            'order_dish_code' => $orderDishCode,
                            'user_id' => $userId,
                            'dish_id' => $order['id'],
                            'quantity' => $order['quantity'],
                            'price' => (float)$order['price'],
                        ];
                    }
                    else if(strpos($data, 'product') !== false){

                        $dbData = [
                            'order_dish_code' => $orderDishCode,
                            'user_id' => $userId,
                            'product_id' => $order['id'],
                            'quantity' => $order['quantity'],
                            'price' => (float)$order['price'],
                        ];
                    }

                    $amount += $requestData[$data]['quantity'] * (float)$requestData[$data]['price'];
                    OrderDish::create($dbData);

                }
                Session::put('order_dish_amount', $amount);


                return response()->json(['message' => 'Saved']);
            }
            else throw new \Exception('No autenticado', 301);
        }
        catch(\Exception $e){
            return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()]);
        }


    }
}
