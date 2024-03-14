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
        <h1 class="title">Mis pedidos</h1>
        @if(sizeof($orders) > 0)
            <div class="w-90 card-group">
                @foreach($orders as $order)
                    <x-default-card href="{{ route('order.show', ['id' => $order->order_id]) }}" id="order{{$order->order_id}}">
                        <div class="dish-info p-3 flex flex-col gap-10">
                            <div class="h-100">
                                <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $order->order_dish_code }}</h2>
                            </div>
                            <div class="h-1/4">
                                <h2 class="mb-5 text-lg font-bold text-gray-900 dark:text-white">
                                    Fecha del pedido</h2>
                                    <p>{{ $order->order_date }}</p>
                            </div>
                            <div class="h-1/4">
                                <h2 class="mb-5 text-lg font-bold text-gray-900 dark:text-white">
                                    Estado del pedido</h2>
                                    <p>{{ $order->order_status }}</p>
                            </div>
                            <div class="h-1/4">
                                <h2 class="mb-5 text-lg font-bold text-gray-900 dark:text-white">
                                    Dirección del pedido</h2>
                                    <p>{{ $order->order_address }}</p>
                            </div>
                        </div>
                    </x-default-card>
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
