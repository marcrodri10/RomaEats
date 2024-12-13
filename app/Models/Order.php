<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'order_date',
        'order_status',
        'order_total_price',
        'user_comments',
        'order_dish_code',
        'order_address',
    ];

    public static function getAllOrders(){
        return self::all();
    }

    public static function getUserOrders($userId){
        return Order::where('user_id', $userId)->get();
    }
    public static function getOrder($orderId){
        return Order::join('users', 'orders.user_id', '=', 'users.id')
        ->where('order_id', $orderId)
        ->get();
    }

    public static function createOrder($data)
    {
        return self::create($data);
    }
}
