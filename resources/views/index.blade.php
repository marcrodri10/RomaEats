<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/css/components/landing.css', 'resources/js/components/landing.js', 'resources/js/components/dishes.js'])
</head>

<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main id="landing">
        <form class="flex justify-center mt-32">
            {{-- <div class="w-1/2">
                <x-search-input placeholder=""></x-search-input>
            </div> --}}
        </form>
        <div class="main-info flex justify-center items-center mt-20">
            <div class="flex gap-8 w-90 lg:flex-row flex-col">
                <div class="info-left flex flex-col lg:w-1/2 w-100 justify-center items-center border-l-2 border-black">
                    <div class="info-data lg:w-100 lg:h-100 justify-center items-center h-72">
                        <h2 class="text-3xl font-bold w-100 landing-h2 ">Tu creatividad, nuestro servicio</h2>
                        <ul class="flex flex-col w-100 landing-ul justify-between">
                            <x-li-check-svg>Diseña tus propias recetas</x-li-check-svg>
                            <x-li-check-svg>Cocinamos por ti</x-li-check-svg>
                            <x-li-check-svg>Envíos en toda la península</x-li-check-svg>
                            <li> <x-primary-anchor class="ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8"
                                    href="{{ route('dishes') }}">
                                    {{ __('Haz tu pedido') }}
                                </x-primary-anchor></li>
                        </ul>
                    </div>

                </div>
                <div class="info-right lg:w-1/2 w-100 flex justify-center items-center h-auto">
                    <img src='img/landing1.jpeg' alt="meat" class="w-auto">
                </div>
            </div>
        </div>

        <div class="steps-info  mt-20 w-100 flex justify-center">
            <x-card-landing></x-card-landing>
        </div>

        <div class="food-summary mt-20 w-100 flex flex-col justify-center items-center mb-10">

            <div class="dishes w-90 card-group" id="dishes">
                @foreach ($dishes as $dish)
                    <x-add-cart-card href="{{ route('dishes.show', ['id' => $dish->dish_id]) }}" id="{{$dish->dish_id}}">

                        <div class="w-100 h-50">
                            <img src="img/{{ $dish->dish_image }}" alt="dish" class="w-100 h-100 dish-image">
                        </div>
                        <div class="dish-info p-3 flex flex-col h-25 justify-between">
                            <div class="h-1/4">
                                <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $dish->dish_name }}</h2>
                            </div>

                            <div class="h-1/4 flex items-center ">
                                <p class=" font-normal text-gray-700 dark:text-gray-400">{{ $dish->dish_price }}€</p>
                            </div>
                        </div>
                    </x-add-cart-card>
                @endforeach
            </div>

            <x-primary-anchor class="ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16"
                href="{{ route('dishes') }}">
                {{ __('VER TODOS') }}
            </x-primary-anchor>
        </div>
    </main>

</body>

</html>
