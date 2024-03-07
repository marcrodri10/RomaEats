<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDish extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_dish_id';

    protected $table = 'user_dishes';
    protected $fillable = [
        'user_dish_name',
        'user_dish_description',
        //'user_dish_price',
        'calories',
        'proteins',
        'carbohydrates',
        'fats',
        'quantity',
        'user_recipe_id',
        'user_id',
    ];
}
