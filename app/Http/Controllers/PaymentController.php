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
            $now =  new \DateTime();
            $card_fields = [
                "card_name" => $request->name,
                "card_number" => $request->card,
                "cvv" => Hash::make($request->cvv),
                "user_id" => Auth::user()->id,
            ];

            Card::create($card_fields);

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
                'card_id' => Card::where('card_number', $card_fields['card_number'])->first()->card_id,
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
