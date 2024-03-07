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
}
