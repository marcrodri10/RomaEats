<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ingredients = [
            'Salmón',
            'Espárragos',
            'Pollo',
            'Arroz Integral',
            'Verduras',
            'Quinoa',
            'Berenjena',
            'Calabacín',
            'Pimientos',
            'Champiñones',
            'Batata',
            'Brócoli',
            'Pavo',
            'Curry',
            'Arroz Basmati',
            'Espinacas',
            'Pejerrey',
            'Mango',
            'Cilantro',
            'Garbanzos',
            'Aguacate',
            'Tomate Cherry',
            'Pepino',
            'Cebolla Roja',
            'Limón',
            'Frijoles',
            'Tomates',
            'Zanahorias',
            'Cebolla',
            'Tomates',
            'Especias',
            'Fideos Integrales',
            'Apio',
            'Arroz',
            'Lentejas',
        ];

        // Insertar los ingredientes en la base de datos
        foreach ($ingredients as $ingredient) {
            Ingredient::create(['ingredient_name' => $ingredient]);
        }

    }
}
