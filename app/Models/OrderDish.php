<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDish extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_dish_id';

    protected $table = 'order_dish';
    protected $fillable = [
        'order_dish_code',
        'user_id',
        'user_dish_id',
        'dish_id',
        'product_id',
        'quantity',
        'price',
    ];

    public static function getUserOrders($orderDishCode)
    {
        $userOrders = self::where('order_dish_code', $orderDishCode)
            ->selectRaw('order_dish.*, order_dish.quantity as user_quantity')
            ->get();

        $data = [];
        foreach ($userOrders as $order) {
            if ($order->dish_id !== null) {
                $dishOrder = self::join('dishes', 'order_dish.dish_id', '=', 'dishes.dish_id')
                    ->select('order_dish.*', 'dishes.*')
                    ->where('order_dish_id', $order->order_dish_id)
                    ->selectRaw('order_dish.quantity as user_quantity')
                    ->get();
                $data[] = $dishOrder;
            } elseif ($order->product_id !== null) {
                $productOrder = self::join('user_products', 'order_dish.product_id', '=', 'user_products.user_product_id')
                    ->select('order_dish.*', 'user_products.*')
                    ->where('order_dish_id', $order->order_dish_id)
                    ->selectRaw('order_dish.quantity as user_quantity')
                    ->get();
                $data[] = $productOrder;
            }
        }

        return $data;
    }

    public static function createOrder($requestData, $orderDishCode, $userId)
    {
        $amount = 0;

        foreach ($requestData as $data => $order) {
            $dbData = [
                'order_dish_code' => $orderDishCode,
                'user_id' => $userId,
                'quantity' => $order['quantity'],
                'price' => (float)$order['price'],
            ];

            if (strpos($data, 'dish') !== false) {
                $dbData['dish_id'] = $order['id'];
            } elseif (strpos($data, 'product') !== false) {
                $dbData['product_id'] = $order['id'];
            }

            $amount += $order['quantity'] * (float)$order['price'];
            self::create($dbData);
        }

        return $amount;
    }
}

