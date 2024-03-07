<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/css/components/dishes.css', 'resources/js/components/dishes.js'])
</head>

<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main class="dishes mt-32 flex flex-col justify-center items-center">
        <div class="title flex w-90 justify-center items-center">
            <h1>Nuestros platos</h1>
        </div>
        <div class="cards-with-pager flex flex-col justify-center items-center w-90">
            <div class="dishes w-90 card-group" id="dishes">

                @foreach ($dishes as $dish)

                    <x-default-card img="{{$dish->dish_image}}" href="{{route('dishes.show', ['id' => $dish->dish_id])}}" id="{{ $dish->dish_id }}" price="{{ $dish->dish_price }}">{{ $dish->dish_name }}</x-default-card>
                @endforeach

            </div>

            <div class="mt-12 mb-12 flex">
                {{ $dishes->links() }}

            </div>
        </div>

    </main>
</body>
