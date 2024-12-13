<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Dish;

class DishController extends Controller
{
    // Listar platos paginados
    public function index()
    {
        $dishes = Dish::getPaginatedDishes();  // Usamos el método del modelo
        return view('dishes', compact('dishes'));
    }

    // Mostrar detalles de un plato específico
    public function showDish(Request $request)
    {
        $id = $request->route('id');
        $dish = Dish::getDishById($id);  // Usamos el método del modelo

        return view('dish-full', ['dish' => $dish]);
    }

    // Obtener todos los platos
    public function getAllDishes()
    {
        return Dish::getAllDishes();  // Usamos el método del modelo
    }

}
