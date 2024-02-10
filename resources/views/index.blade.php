<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/components/landing.css'])
    </head>
    <body>
        <x-navbar></x-navbar>
        <form class="flex justify-center">
            <div class="w-1/2">
                <x-search-input ></x-search-input>
            </div>
        </form>
        <div class="main-info flex justify-center items-center mt-20">
            <div class="flex gap-8 width-80">
                <div class="info-left flex flex-col w-1/2 justify-center items-center">
                    <h2 class="text-3xl font-bold w-100 landing-h2">Tu creatividad, nuestro servicio</h2>
                    <ul class="flex flex-col w-100 landing-ul justify-between">
                        <x-li-check-svg>Diseña tus propias recetas</x-li-check-svg>
                        <x-li-check-svg>Cocinamos por ti</x-li-check-svg>
                        <x-li-check-svg>Envíos en toda la península</x-li-check-svg>
                        <li> <x-primary-button class="ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8">
                            {{ __('Haz tu pedido') }}
                        </x-primary-button></li>
                    </ul>
                </div>
                <div class="info-right w-1/2 flex justify-center items-center">
                    <img src="{{ URL::to('img/landing1.jpeg') }}" alt="meat">
                </div>
            </div>
        </div>

        <div class="steps-info  mt-20 w-100 flex justify-center">
            <x-card-landing width="80%" ></x-card-landing>
        </div>

        <div class="food-summary mt-20 w-100 flex flex-col justify-center  items-center mb-10">
            <div class="dishes width-80 bg-gray-100 flex justify-between">
                <x-default-card  price="6,50">Costillar de cerdo</x-default-card>
                <x-default-card  price="6,50">Costillar de cerdo</x-default-card>
                <x-default-card  price="6,50">Costillar de cerdo</x-default-card>
                <x-default-card  price="6,50">Costillar de cerdo</x-default-card>
            </div>
            <x-primary-button class="ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16">
                {{ __('VER TODOS') }}
            </x-primary-button>
        </div>
    </body>
</html>
