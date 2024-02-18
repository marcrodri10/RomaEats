<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $dishes = [
            [
                'dish_name' => 'Salmón al Horno con Espárragos',
                'dish_description' => 'Filete de salmón al horno con espárragos frescos y una pizca de limón.',
                'dish_price' => 12.75,
                'calories' => 420,
                'proteins' => 30,
                'fats' => 20,
                'carbohydrates' => 10,
                'quantity' => 400,
                'ingredients' => [
                    ['ingredient_id' => 1, 'quantity' => '300 gramos'],
                    ['ingredient_id' => 2, 'quantity' => '100 gramos'],
                ],
            ],
            [
                'dish_name' => 'Pollo a la Parrilla con Vegetales Asados',
                'dish_description' => 'Pechuga de pollo magra marinada y asada a la parrilla, servida con una variedad de vegetales asados.',
                'dish_price' => 10.25,
                'calories' => 380,
                'proteins' => 28,
                'fats' => 15,
                'carbohydrates' => 30,
                'quantity' => 350,
                'ingredients' => [
                    ['ingredient_id' => 3, 'quantity' => '300 gramos'],
                    ['ingredient_id' => 5, 'quantity' => '50 gramos'],
                ],
            ],
            [
                'dish_name' => 'Tazón de Arroz Integral con Verduras',
                'dish_description' => 'Arroz integral cocido servido con una variedad de verduras salteadas y aderezado con salsa de soja baja en sodio.',
                'dish_price' => 9.00,
                'calories' => 320,
                'proteins' => 8,
                'fats' => 6,
                'carbohydrates' => 60,
                'quantity' => 400,
                'ingredients' => [
                    ['ingredient_id' => 4, 'quantity' => '250 gramos'],
                    ['ingredient_id' => 5, 'quantity' => '150 gramos'],
                ],
            ],
            [
                'dish_name' => 'Pollo al Horno con Batata Asada',
                'dish_description' => 'Pechuga de pollo sazonada al horno servida con batata asada y brócoli al vapor.',
                'dish_price' => 10.25,
                'calories' => 380,
                'proteins' => 28,
                'fats' => 10,
                'carbohydrates' => 45,
                'quantity' => 400,
                'ingredients' => [
                    ['ingredient_id' => 3, 'quantity' => '200 gramos'],
                    ['ingredient_id' => 11, 'quantity' => '200 gramos'],
                ],
            ],
            [
                'dish_name' => 'Pavo al Curry con Arroz Basmati',
                'dish_description' => 'Tiras de pavo cocidas en una deliciosa salsa de curry, servidas con arroz basmati y espinacas salteadas.',
                'dish_price' => 12.50,
                'calories' => 420,
                'proteins' => 32,
                'fats' => 14,
                'carbohydrates' => 40,
                'quantity' => 380,
                'ingredients' => [
                    ['ingredient_id' => 13, 'quantity' => '200 gramos'],
                    ['ingredient_id' => 15, 'quantity' => '175 gramos'],
                    ['ingredient_id' => 14, 'quantity' => '5 gramos'],
                ],
            ],
            [
                'dish_name' => 'Tacos de Pescado con Salsa de Mango',
                'dish_description' => 'Tacos de pescado fresco a la parrilla servidos con una refrescante salsa de mango y cilantro.',
                'dish_price' => 13.75,
                'calories' => 360,
                'proteins' => 25,
                'fats' => 16,
                'carbohydrates' => 30,
                'quantity' => 350,
                'ingredients' => [
                    ['ingredient_id' => 17, 'quantity' => '300 gramos'],
                    ['ingredient_id' => 18, 'quantity' => '50 gramos'],
                ],
            ],
            [
                'dish_name' => 'Ensalada de Garbanzos y Aguacate',
                'dish_description' => 'Ensalada de garbanzos, aguacate, tomate cherry, pepino y cebolla roja con aderezo de limón y cilantro.',
                'dish_price' => 9.00,
                'calories' => 320,
                'proteins' => 18,
                'fats' => 15,
                'carbohydrates' => 35,
                'quantity' => 300,
                'ingredients' => [
                    ['ingredient_id' => 20, 'quantity' => '200 gramos'],
                    ['ingredient_id' => 21, 'quantity' => '100 gramos'],
                ],
            ],
            [
                'dish_name' => 'Arroz con Pollo y Vegetales al Estilo Asiático',
                'dish_description' => 'Arroz integral cocido con tiras de pollo, zanahorias, guisantes, y salsa de soja baja en sodio.',
                'dish_price' => 11.50,
                'calories' => 380,
                'proteins' => 24,
                'fats' => 10,
                'carbohydrates' => 45,
                'quantity' => 400,
                'ingredients' => [
                    ['ingredient_id' => 35, 'quantity' => '300 gramos'],
                    ['ingredient_id' => 9, 'quantity' => '20 gramos'],
                    ['ingredient_id' => 10, 'quantity' => '20 gramos'],
                    ['ingredient_id' => 28, 'quantity' => '20 gramos'],
                    ['ingredient_id' => 29, 'quantity' => '20 gramos'],
                    ['ingredient_id' => 30, 'quantity' => '20 gramos'],
                ],
            ],
            [
                'dish_name' => 'Lentejas Estofadas',
                'dish_description' => 'Lentejas cocidas lentamente con cebolla, zanahorias, tomates y especias.',
                'dish_price' => 6.99,
                'calories' => 280,
                'proteins' => 18,
                'fats' => 2,
                'carbohydrates' => 50,
                'quantity' => 300,
                'ingredients' => [
                    ['ingredient_id' => 36, 'quantity' => '200 gramos'],
                    ['ingredient_id' => 21, 'quantity' => '100 gramos'],
                ],
            ],
            [
                'dish_name' => 'Chili con Carne',
                'dish_description' => 'Estofado de carne molida de res con frijoles, tomates, cebolla y especias.',
                'dish_price' => 8.99,
                'calories' => 350,
                'proteins' => 25,
                'fats' => 10,
                'carbohydrates' => 40,
                'quantity' => 350,
                'ingredients' => [
                    ['ingredient_id' => 36, 'quantity' => '200 gramos'],
                    ['ingredient_id' => 21, 'quantity' => '100 gramos'],
                ],
            ],
            [
                'dish_name' => 'Quinoa con Verduras Asadas',
                'dish_description' => 'Quinoa cocida con berenjena, calabacín, pimientos y champiñones asados al horno.',
                'dish_price' => 9.50,
                'calories' => 320,
                'proteins' => 12,
                'fats' => 8,
                'carbohydrates' => 50,
                'quantity' => 300,
                'ingredients' => [
                    ['ingredient_id' => 6, 'quantity' => '200 gramos'],
                    ['ingredient_id' => 21, 'quantity' => '100 gramos'],
                ],
            ],
            [
                'dish_name' => 'Sopa de Pollo con Fideos Integrales',
                'dish_description' => 'Sopa casera de pollo con fideos integrales, zanahorias, apio y cebolla.',
                'dish_price' => 7.25,
                'calories' => 280,
                'proteins' => 20,
                'fats' => 6,
                'carbohydrates' => 35,
                'quantity' => 300,
                'ingredients' => [
                    ['ingredient_id' => 33, 'quantity' => '200 gramos'],
                    ['ingredient_id' => 21, 'quantity' => '100 gramos'],
                ],
            ],
            [
                'dish_name' => 'Pavo al Horno con Puré de Batata',
                'dish_description' => 'Pechuga de pavo sazonada y horneada, servida con puré de batata y brócoli al vapor.',
                'dish_price' => 10.75,
                'calories' => 380,
                'proteins' => 30,
                'fats' => 12,
                'carbohydrates' => 40,
                'quantity' => 350,
                'ingredients' => [
                    ['ingredient_id' => 13, 'quantity' => '200 gramos'],
                    ['ingredient_id' => 11, 'quantity' => '100 gramos'],
                ],
            ],

        ];

        foreach ($dishes as $dishData) {
            // Crea el plato
            $dish = Dish::create([
                'dish_name' => $dishData['dish_name'],
                'dish_description' => $dishData['dish_description'],
                'dish_price' => $dishData['dish_price'],
                'calories' => $dishData['calories'],
                'proteins' => $dishData['proteins'],
                'fats' => $dishData['fats'],
                'carbohydrates' => $dishData['carbohydrates'],
                'quantity' => $dishData['quantity'],
            ]);

            // Verifica si hay ingredientes y adjúntalos al plato
            if (isset($dishData['ingredients'])) {
                foreach ($dishData['ingredients'] as $ingredient) {
                    // Asegúrate de que el ingrediente exista en la base de datos antes de adjuntarlo
                    $ingredientFound = Ingredient::find($ingredient['ingredient_id']);
                    if ($ingredientFound) {
                        // Adjunta el ingrediente al plato con el ID del plato
                        $dish->ingredients()->attach($ingredient['ingredient_id'], ['quantity' => $ingredient['quantity']]);
                    }
                }
            }
        }
    }
}
