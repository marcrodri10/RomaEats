<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/components/products.css', 'resources/js/components/user-dish.js'])
</head>

<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main class="products-div mt-32 flex justify-center flex-col items-center">
        <div class="user-products-container flex justify-center flex-col items-center" id="products-div">
            <div class="links flex gap-10">
                <a class=" text-lg hover:text-green-600" href="{{ route('recipe.index') }}">Mis recetas</a>
                <a class="underline text-lg hover:text-green-600" href="{{ route('mydishes.index') }}">Mis platos</a>
            </div>
            <h1 class="title mt-6">Mis platos</h1>

            @if (session('product_add') === 'added')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
            @if (session('error'))
                <p>{{ session('error') }}</p>
            @endif
            @if (sizeof($userDishes) == 0)
                <div class="empty-products flex flex-col justify-center items-center mt-40 h-80">
                    <p>Todavía no has añadido ningún plato</p>
                    <x-button-with-icon id="add-recipe" value="add" type="submit"
                        class="ms-3 bg-green-700 pt-3 pb-3 pl-7 pr-7 flex justify-center mt-8 modal relative"
                        href="dishes">
                        {{ __('AÑADIR') }}
                    </x-button-with-icon>
                </div>
            @else
                <div class="products width-80 flex flex-wrap justify-center items-center" id="products">

                    @foreach ($userDishes as $userDish)
                        <x-default-card id="user-dish{{ $userDish->user_dish_id }}"
                            href="{{ route('mydishes.show', ['id' => $userDish->user_dish_id]) }}">

                            <div class="user-dish-info">
                                <div class="">
                                    <h2 class="mb-5 text-2xl underline font-bold tracking-tight text-gray-900 dark:text-white">
                                        Plato {{ $userDish->user_dish_id }}</h2>
                                </div>
                                <div class="">
                                    <h2 class="mb-5 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Plato {{ $userDish->user_dish_name }}</h2>
                                </div>
                                <div class="">
                                    <h2 class="mb-5 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Plato {{ $userDish->user_dish_name }}</h2>
                                </div>
                            </div>
                        </x-default-card>
                    @endforeach

                </div>
                <div class="add-btn">
                    <x-button-with-icon id="add-recipe" value="add" type="submit"
                        class="ms-3 bg-green-700 pt-3 pb-3 pl-7 pr-7 flex justify-center mt-8 modal relative"
                        href="dishes">
                        {{ __('AÑADIR') }}
                    </x-button-with-icon>
                </div>
            @endif
        </div>

        <div class="product-form w-100 flex justify-center">
            <form action="{{ route('mydishes.save') }}" method="post"
                class="width-80 absolute top-0 mt-32 hidden p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                id="recipe-form">
                @csrf
                <div class="flex justify-end items-center">
                    <div id="close-modal">
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white modal"
                            data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>
                <div class="content-form mt-10">
                    <div class="recipes-inputs">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="search-product"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  focus:border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Nombre del plato" value="" name="dish_name" autocomplete="off" required>

                        </div>
                        <div class="relative mt-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="search-product"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  focus:border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Calorías" value="" name="calories" autocomplete="off" required>

                        </div>
                        <div class="relative mt-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="search-product"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  focus:border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Carbohidratos" value="" name="carbohydrates" autocomplete="off" required>

                        </div>
                        <div class="relative mt-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="search-product"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  focus:border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Proteínas" value="" name="proteins" autocomplete="off" required>

                        </div>
                        <div class="relative mt-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="search-product"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  focus:border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Grasas" value="" name="fats" autocomplete="off" required>

                        </div>
                        <div class="relative mt-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="search-product"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  focus:border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Cantidad" value="" name="quantity" autocomplete="off" required>

                        </div>
                        @if (sizeof($recipes) != 0)

                        <div class="select-recipe mt-6">
                            <select id="countries" class="h-14 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5">
                                <option value="" disabled selected>Selecciona una receta</option>
                                @foreach($recipes as $recipe)

                                <option value="{{$recipe->user_recipe_id}}">{{$recipe->user_recipe_name}}</option>
                            @endforeach
                            </select>
                        </div>

                    @endif
                    </div>

                    <div class="btn-group">
                        <x-button-with-icon id="add-step" value="add" type="submit"
                            class="ms-3 bg-green-700 pt-3 pb-3 pl-7 pr-7 flex justify-center mt-8 modal">
                            {{ __('GUARDAR') }}
                        </x-button-with-icon>
                    </div>

                </div>
            </form>
        </div>
    </main>

</body>
