<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'user_products';
    protected $fillable = [
        'user_product_name',
        'user_product_brand',
        'user_product_category',
        'user_product_store_location',
        'user_product_nutri_score',
        'user_id',
    ];

}
