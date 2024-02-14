<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/components/landing.css', 'resources/js/components/landing.js'])
</head>

<body>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main id="landing">
        <x-navbar></x-navbar>
        <form class="flex justify-center mt-32">
            <div class="w-1/2">
                <x-search-input placeholder=""></x-search-input>
            </div>
        </form>
        <div class="main-info flex justify-center items-center mt-20">
            <div class="flex gap-8 width-80 lg:flex-row flex-col">
                <div class="info-left flex flex-col lg:w-1/2 w-100 justify-center items-center">
                    <div class="info-data lg:w-100 lg:h-100 justify-center items-center h-72">
                        <h2 class="text-3xl font-bold w-100 landing-h2 ">Tu creatividad, nuestro servicio</h2>
                        <ul class="flex flex-col w-100 landing-ul justify-between">
                            <x-li-check-svg>Diseña tus propias recetas</x-li-check-svg>
                            <x-li-check-svg>Cocinamos por ti</x-li-check-svg>
                            <x-li-check-svg>Envíos en toda la península</x-li-check-svg>
                            <li> <x-primary-anchor class="ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8" href="dishes">
                                    {{ __('Haz tu pedido') }}
                                </x-primary-anchor></li>
                        </ul>
                    </div>

                </div>
                <div class="info-right lg:w-1/2 w-100 flex justify-center items-center h-auto">
                    <img src='img/landing1.jpeg' alt="meat">
                </div>
            </div>
        </div>

        <div class="steps-info  mt-20 w-100 flex justify-center">
            <x-card-landing width="80%"></x-card-landing>
        </div>

        <div class="food-summary mt-20 w-100 flex flex-col justify-center items-center mb-10">
            <div class="dishes width-80 flex flex-wrap justify-between">
                <x-default-card price="6,50">Costillar de cerdo</x-default-card>
                <x-default-card price="6,50">Costillar de cerdo</x-default-card>
                <x-default-card price="6,50">Costillar de cerdo</x-default-card>
                <x-default-card price="6,50">Costillar de cerdo</x-default-card>
            </div>
            <x-primary-anchor class="ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16" href="dishes">
                {{ __('VER TODOS') }}
            </x-primary-anchor>
        </div>
    </main>

</body>

</html>
