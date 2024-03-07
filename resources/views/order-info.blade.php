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
    @extends('layouts.card-info')
    @section('content')
    <div class="title flex justify-center">
        <h1 class="text-2xl">Detalles del pedido</h1>
    </div>
        <p><span class=" font-bold">Nombre:</span> {{$order->name}} {{$order->surname}}</p>
        <p><span class="font-bold">Fecha del pedido:</span> {{$order->order_date}}</p>
        <p><span class="font-bold">Estado del pedido:</span> {{$order->order_status}}</p>
        <p><span class="font-bold">Dirección del pedido:</span> {{$order->order_address}}</p>
        <p><span class="font-bold">Total:</span> {{$order->order_total_price}}€</p>
        @if($order->user_comments ?? '')
        @endif
    @endsection


</body>
</html>
