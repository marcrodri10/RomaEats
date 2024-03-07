<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js',])
</head>

<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main class="orders-div mt-32 flex justify-center flex-col items-center" id="products-div">
        <h1 class="underline">My orders</h1>
        @if(sizeof($orders) > 0)
            <div class="w-90 card-group">
                @foreach($orders as $order)
                    <x-product-card id="{{$order->order_id}}" href="order.show">{{$order->order_dish_code}}</x-product-card>
                @endforeach
            </div>
        @else
        <div class="empty flex flex-col justify-center items-center mt-40 h-80">
            <p>Todavía no has hecho ningún pedido</p>
            <x-primary-anchor id="add-btn" value="add"
                class="ms-3 bg-green-700 pt-3 pb-3 pl-7 pr-7 flex justify-center mt-8 modal relative"
                href="dishes">
                {{ __('PEDIR') }}
            </x-primary-anchor>
        </div>
        @endif
    </main>

</body>
