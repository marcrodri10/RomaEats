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

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/components/payment.css', 'resources/js/components/payment.js'])
</head>

<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <div class="mt-32">
        <div class="bg-white p-6">
            <div class="icon h-1/2">
                <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
                    <path fill="currentColor"
                        d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                    </path>
                </svg>
            </div>

            <div class="text-center h-1/2 ">
                <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">¡Pago hecho!</h3>
                <p class="text-gray-600 my-2">Gracias por completar el pago online.</p>
                <p> ¡Tenga un buen día! </p>
                <div class="text-center mt-5 flex justify-center gap-5">
                    <x-primary-anchor href="/"
                        class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
                        ATRÁS
                    </x-primary-anchor>
                    <x-primary-anchor href="/myorders"
                        class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
                        MIS PEDIDOS
                    </x-primary-anchor>
                </div>
            </div>
        </div>
    </div>
</body>
