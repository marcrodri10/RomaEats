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
            ->selectRaw('order_dish.quantity as user_quantity');
        dd($userOrder->get());
        $userCards = Card::where('user_id', Auth::user()->id)
        ->where('save_card', 1)
        ->get();

        return view('order_dish', ['userOrder' => $userOrder->get(), 'userCards' => $userCards]);
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
                    $requestData[$data]['user_id'] = $userId;
                    $requestData[$data]['dish_id'] = (int)substr($data, strlen($data) - 1, strlen($data));
                    $dbData = [
                        'order_dish_code' => $orderDishCode,
                        'user_id' => $userId,
                        'dish_id' => $order['id'],
                        'quantity' => $order['quantity'],
                        'price' => (float)$order['price'],
                    ];

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
