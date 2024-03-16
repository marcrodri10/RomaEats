<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/components/dishes.js'])
</head>

<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main class="dishes mt-32 flex flex-col justify-center items-center">
        <div class="title flex w-90 justify-center items-center">
            <h class="title">Nuestros platos</h1>
        </div>
        <div class="w-1/2 mt-6 mb-6">
            <x-search-input placeholder=""></x-search-input>
        </div>
        <div class="cards-with-pager flex flex-col justify-center items-center w-90">
            <div class="dishes w-90 card-group" id="dishes">

                @foreach ($dishes as $dish)

                <x-add-cart-card href="{{ route('dishes.show', ['id' => $dish->dish_id]) }}" id="dish{{$dish->dish_id}}">

                    <div class="w-100 h-50">
                        <img src="img/{{ $dish->dish_image }}" alt="dish" class="w-100 h-100 dish-image">
                    </div>
                    <div class="dish-info p-3 flex flex-col h-25 justify-between">
                        <div class="h-1/4">
                            <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $dish->dish_name }}</h2>
                        </div>

                        <div class="h-1/4 flex items-center ">
                            <p class=" font-normal text-gray-700 dark:text-gray-400">{{ $dish->dish_price }}€</p>
                        </div>
                    </div>
                </x-add-cart-card>
                @endforeach

            </div>

            <div class="mt-12 mb-12 flex" id="paginator">
                {{ $dishes->links() }}

            </div>
        </div>

    </main>
</body>
