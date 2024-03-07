<?php

namespace App\Models;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    use HasFactory;


    protected $table = 'dishes';
    protected $primaryKey = 'dish_id';
    protected $fillable = [
        'dish_name',
        'dish_description',
        'dish_price',
        'calories',
        'proteins',
        'carbohydrates',
        'fats',
        'quantity',
        'dish_image',
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'dish_ingredients', 'dish_id', 'ingredient_id');
    }

}
