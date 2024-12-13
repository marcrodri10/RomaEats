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
    public function index(Request $request)
    {
        if ($request->order_response == 'pay') {
            return view('payment');
        } else {
            return Redirect::route('dishes');
        }
    }

    public function pay(Request $request)
    {
        try {
            if ($request->payment === 'pay') {
                $now = new \DateTime();

                // Preparar datos para la tarjeta
                $cardData = [
                    'card_name' => $request->card_name,
                    'card_number' => $request->card,
                    'cvv' => $request->cvv,
                    'validation_date' => $request->validation_date,
                    'save_card' => $request->save_card ? 1 : 0,
                    'user_id' => Auth::user()->id,
                ];

                // Manejar tarjeta y obtener el ID
                $cardId = Card::findOrCreateCard($cardData);

                // Preparar datos para la orden
                $orderData = [
                    'order_date' => $now->format('Y-m-d H:i:s'),
                    'order_status' => 'Paid',
                    'order_total_price' => session('order_dish_amount'),
                    'user_comments' => "",
                    'user_id' => Auth::user()->id,
                    'order_dish_code' => session('order_dish_code'),
                    'order_address' => $request->address,
                ];

                // Crear la orden
                $order = Order::createOrder($orderData);
                
                // Preparar datos para el pago
                $paymentData = [
                    'card_id' => $cardId,
                    'user_id' => Auth::user()->id,
                    'payment_date' => $now->format('Y-m-d'),
                    'order_id' => $order->order_id,
                    'total_payed' => session('order_dish_amount'),
                ];
                // Crear el pago
                Payment::createPayment($paymentData);

                return view('successful-payment');
            } else {
                return Redirect::to('dishes');
            }
        } catch (\Exception $e) {
            return Redirect::route('order.index')->with('error', $e->getMessage());
        }
    }
}