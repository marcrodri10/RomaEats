<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/components/orders.css', 'resources/js/components/order_id.js'])
</head>

<body>
    <x-navbar-employee></x-navbar-employee>
    <main class="container-div mt-32 flex justify-center flex-col items-center" id="products-div">


        @if (sizeof($order) > 0)
            <div class="width-80 flex justify-center" id="orders">
                @foreach ($order as $o)

                <div class="flex-col items-center">
                    @isset($o->name, $o->surname)<p  id="{{$o->order_dish_code}}" class="order-code font-normal text-gray-700 dark:text-gray-400">Pedido: {{$o->order_dish_code}}</p>@endisset
                    @isset($o->name, $o->surname)<p class=" font-normal text-gray-700 dark:text-gray-400">Cliente: {{$o->name}} {{$o->surname}}</p>@endisset
                    <p class=" font-normal text-gray-700 dark:text-gray-400" id="address">Dirección: {{$o->order_address}}</p>
                    @isset($o->phone)<p class=" font-normal text-gray-700 dark:text-gray-400">{{$o->phone}}</p>@endisset
                </div>
                @endforeach
            </div>
        @endif
        <div id="map" class="mt-6"></div>

        <div id="map-info"></div>
    </main>

</body>
