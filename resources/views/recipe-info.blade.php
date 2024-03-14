<!DOCTYPE html>
<html lang="800px !important">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/components/product-full.css'])
</head>
<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main>
        <x-full-card>
            <div
                class="w-100 p-6 flex flex-col ml-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 gap-10">
                <div class="title flex justify-center">
                    <h1 class="text-2xl">Detalles de la receta</h1>
                </div>
                <div class="recipe-info  flex flex-col lg:flex-row gap-10">
                    <div class="data flex flex-col gap-10 w-1/2">
                        <div class="flex flex-col items-center">
                            <h2 class=" mb-5 text-lg font-bold text-gray-900 dark:text-white">
                                Receta</h2>
                                <p class="">{{ $recipe->user_recipe_id }}</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <h2 class=" mb-5 text-lg font-bold text-gray-900 dark:text-white">
                                Nombre</h2>
                                <p class="">{{ $recipe->user_recipe_name }}</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <h2 class=" mb-5 text-lg font-bold text-gray-900 dark:text-white">
                                Descripción</h2>
                                <p class="">{{ $recipe->user_recipe_description }}</p>
                        </div>
                    </div>
                    <div class="steps flex flex-col gap-10 w-1/2">
                        @foreach ($steps as $step)
                        <div class="flex flex-col items-center">
                            <h2 class=" mb-5 text-lg font-bold text-gray-900 dark:text-white">
                                Paso {{$loop->index + 1}}</h2>
                                <p class="">{{ $step->recipe_step_description }}</p>
                        </div>

                        @endforeach
                    </div>

                </div>
            </div>
        </x-full-card>


    </main>


</body>
</html>
