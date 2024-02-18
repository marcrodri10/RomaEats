<?php

namespace App\Models;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $primaryKey = 'ingredient_id';

    protected $table = 'ingredients';
    protected $fillable = [
        'ingredient_name',
    ];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
