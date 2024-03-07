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

        <div class="full w-100 mt-32 flex justify-center">
            <div class="product w-90 flex items-center">
                <div class="w-100 flex flex-col lg:flex-row ml-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-5">
                    <div class="lg:w-50 w-100 flex flex-col justify-center p-2">
                        <div class="flex flex-col gap-6 items-center">

                            @foreach ($recipe->toArray() as $key => $value)
                                @if (!in_array($key,  ['created_at', 'updated_at', 'user_recipe_id', 'user_id']) && $value !== "")
                                    <div class="product-data flex">
                                        <h2 class="text-xl font-bold">
                                            {{ ucfirst(explode('_', $key)[sizeof(explode('_', $key)) - 1]) }}</h2>
                                        <p class="text-xl">: {{ $value }}</p>
                                    </div>
                                @endif
                            @endforeach
                            <h2 class="mb-5 text-xl font-bold tracking-tight text-gray-900 dark:text-white"></h2>
                        </div>
                    </div>
                    <div class="lg:w-50 w-100 flex flex-col justify-center p-2">
                        <div class="flex flex-col gap-6 items-center">
                            <h1 class="text-xl">Pasos de la receta</h1>
                            @foreach ($steps as $step => $val)
                                @foreach($val->toArray() as $key => $value)
                                @if (!in_array($key,  ['created_at', 'updated_at', 'user_recipe_id', 'user_id', 'recipe_steps_id']) && $value !== "")
                                    <div class="product-data flex">
                                        <p class="text-xl">Paso {{ $step + 1}}:</p>
                                        <p class="text-xl">&nbsp; {{$value }}</p>
                                    </div>
                                @endif
                                @endforeach
                            @endforeach
                            <h2 class="mb-5 text-xl font-bold tracking-tight text-gray-900 dark:text-white"></h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>


</body>
</html>
