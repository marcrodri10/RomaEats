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
        'quantity',
        'price',
    ];
}
