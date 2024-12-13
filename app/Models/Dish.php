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

    // Relación con ingredientes
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'dish_ingredients', 'dish_id', 'ingredient_id');
    }

    // Obtener platos paginados
    public static function getPaginatedDishes($perPage = 5)
    {
        return self::orderBy('dish_name', 'ASC')
            ->with('ingredients') // Cargar ingredientes relacionados
            ->paginate($perPage);
    }

    // Obtener plato por ID
    public static function getDishById($id)
    {
        return self::find($id);
    }

    // Obtener todos los platos
    public static function getAllDishes()
    {
        return self::orderBy('dish_name', 'ASC')->get();
    }
    public static function getSomeDishes($dishes){
        return Dish::take($dishes)->get();
    }
}

