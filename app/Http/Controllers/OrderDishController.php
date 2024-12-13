<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\OrderDish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderDishController extends Controller
{
    public function index()
    {
        $orderDishCode = session('order_dish_code');

        // Consultar las órdenes del usuario
        $userOrder = OrderDish::getUserOrders($orderDishCode);

        // Consultar tarjetas guardadas del usuario
        $userCards = Card::getUserSavedCards(Auth::user()->id);

        return view('order_dish', [
            'userOrder' => $userOrder,
            'userCards' => $userCards,
        ]);
    }

    public function addOrder(Request $request)
    {
        try {
            if (Auth::check()) {
                $requestData = $request->json()->all();

                $userId = Auth::user()->id;
                $currentDate = new \DateTime();
                $orderDishCode = 'O' . $currentDate->format('YmdHis') . $userId;

                // Guardar el código de la orden en la sesión
                Session::put('order_dish_code', $orderDishCode);

                // Crear las órdenes y calcular el monto total
                $amount = OrderDish::createOrder($requestData, $orderDishCode, $userId);

                // Guardar el monto total en la sesión
                Session::put('order_dish_amount', $amount);

                return response()->json(['message' => 'Saved']);
            } else {
                throw new \Exception('No autenticado', 301);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
        }
    }
}
