<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_recipe_id';

    protected $table = 'user_recipes';
    protected $fillable = [
        'user_recipe_id',
        'user_recipe_name',
        'user_recipe_description',
        'user_id',
    ];
}
