<!DOCTYPE html>
<html lang="800px !important">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <x-full-card>
        <div
            class="w-100 p-6 flex flex-col ml-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 gap-10">
            <div class="title flex justify-center">
                <h1 class="text-2xl">Detalles del pedido</h1>
            </div>
            <div class="order-info flex flex-col lg:flex-row gap-10 justify-center">
                <div class="flex flex-col justify-center">
                    <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                        Nombre</h2>
                        <p class="text-center">{{ $order->name }}</p>
                </div>
                <div class="flex flex-col justify-center">
                    <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                        Apellidos </h2>
                        <p class="text-center">{{ $order->surname }}</p>
                </div>
                <div class="flex flex-col justify-center">
                    <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                        Fecha del pedido </h2>
                        <p class="text-center">{{ $order->order_date }}</p>
                </div>
                <div class="flex flex-col justify-center">
                    <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                        Estado del pedido </h2>
                        <p class="text-center">{{ $order->order_status }}</p>
                </div>
                <div class="flex flex-col justify-center">
                    <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                        Dirección del pedido </h2>
                        <p class="text-center">{{ $order->order_address }}</p>
                </div>
                <div class="flex flex-col justify-center">
                    <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                        Coste total del pedido </h2>
                        <p class="text-center">{{ $order->order_total_price }} €</p>
                </div>
                @if ($order->user_comments ?? '')
            </div>
            @endif
        </div>
    </x-full-card>


</body>

</html>
