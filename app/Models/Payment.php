<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_id';

    protected $table = 'payments';
    protected $fillable = [
        'user_id',
        'card_id',
        'order_id',
        'payment_date',
        'total_payed',
        'price',

    ];
}
