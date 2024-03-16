<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app-employee.js', 'resources/css/components/orders.css', 'resources/js/components/orders.js'])
</head>

<body>
    <x-road-route-modal></x-road-route-modal>
    <x-navbar-employee></x-navbar-employee>
    <main class="container-div mt-32 flex justify-center flex-col items-center" id="products-div">
        <div class="range-div w-50">
            <div class="range flex  gap-5">
                <div class="range-bar flex-col w-10/12 items-center">
                    <label for="minmax-range" class="h-50 block text-sm font-medium text-gray-900 dark:text-white">Min-max range</label>
                    <input id="km-range" type="range" min="5" max="125" value="5" step="5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                </div>
                <span class="flex w-1/12 items-center mt-6" id="range-value">5 km</span>
            </div>

            <div class="range-values flex justify-between w-10/12">
                <span class="text-sm text-gray-500 dark:text-gray-400">5 km</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">125 km</span>
            </div>

        </div>



        <div id="map" class="mt-6"></div>
        <div class="orders-div flex justify-center flex-col items-center mt-10 w-100">
            <h1 class="underline">Orders</h1>
            @if (sizeof($orders) > 0)
                <div class="w-90 card-group" id="orders">
                    {{-- @foreach ($orders as $order)
                        <x-basic-card id="{{ $order->order_id }}" address="{{ $order->order_address }}"
                            phone="{{ $order->phone }}" name="{{ $order->name }}" surname="{{ $order->surname }}">
                            {{ $order->order_dish_code }}
                        </x-basic-card>
                    @endforeach --}}
                </div>
            @else
                <div class="empty-products flex flex-col justify-center items-center mt-40 h-80">
                    <p>Actualmente no hay ningún pedido</p>
                </div>
            @endif
        </div>

    </main>

</body>
