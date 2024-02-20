<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/components/dishes.css'])
</head>

<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main class="dishes mt-32 flex justify-center">
        <div class="dishes-cards width-80 flex items-center flex-wrap justify-center" id="dishes">

            @foreach ($dishes as $dish)
                <x-default-card id="{{ $dish->dish_id }}" price="{{ $dish->dish_price }}">{{ $dish->dish_name }}</x-default-card>
            @endforeach

        </div>

        <div class="">
            {{ $dishes->links() }}

        </div>
    </main>
</body>
