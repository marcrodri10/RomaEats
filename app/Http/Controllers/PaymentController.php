<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dish;

class PaymentController extends Controller
{
    //
    function index(Request $request)
    {
        if ($request->order_response == 'pay') return view('payment');
        else {
            //OrderDish::where('order_dish_code', session('order_dish_code'))->delete();
            return Redirect::route('dishes');
        }
    }

    function pay(Request $request)
    {
        if ($request->payment == 'pay') {
            $realUserCard = Card::where('card_number', $request->card)->first();
            if($realUserCard !== null){
                if($realUserCard->user_id !== Auth::user()->id) throw new \Exception ('Tarjeta ya en uso');
                else {
                    if(Hash::check($request->cvv, $realUserCard->cvv)){
                        $cardId = $realUserCard->card_id;
                        if($request->save_card){
                            $realUserCard->save_card = 1;
                            $realUserCard->save();
                        }
                    }

                }
            }
            else {
                if($request->save_card) $save = 1;
                else $save = 0;
                $card_fields = [
                    "card_name" => $request->name,
                    "card_number" => $request->card,
                    "cvv" => Hash::make($request->cvv),
                    'validation_date' => $request->validation_date,
                    'save_card' => $save,
                    "user_id" => Auth::user()->id,
                ];
                Card::create($card_fields);
                $cardId = Card::where('card_number', $card_fields['card_number'])->first()->card_id;
            }
            $now =  new \DateTime();




            $order_fields = [
                'order_date' => $now->format('Y-m-d H:i:s'),
                'order_status' => 'Paid',
                'order_total_price' => session('order_dish_amount'),
                'user_comments' => "",
                'user_id' => Auth::user()->id,
                'order_dish_code' => session('order_dish_code'),
                'order_address' =>  $request->address,
            ];

            Order::create($order_fields);

            $payment_fields = [
                'card_id' => $cardId,
                'user_id' => Auth::user()->id,
                'payment_date' => $now->format('Y-m-d'),
                'order_id' => Order::where('order_dish_code', session('order_dish_code'))->first()->order_id,
                'total_payed' => session('order_dish_amount'),
            ];

            Payment::create($payment_fields);

            return view('successful-payment');
        }
        else {
            return redirect::to('dishes');
        }
    }
}
