<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app-employee.js', 'resources/css/components/landing.css', 'resources/js/components/landing.js'])
</head>

<body>
    <x-road-route-modal></x-road-route-modal>
    <x-navbar-employee></x-navbar-employee>
    <main id="landing" class="flex justify-center">
        <div class="welcome mt-32 flex-col justify-center items-center">
            <h1>Bienvenido de nuevo {{auth()->user()->name}} {{auth()->user()->surname}}</h1>
            <div class="orders flex justify-center">
                <x-primary-anchor href="orders" class="ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16">VER PEDIDOS</x-primary-anchor>
            </div>

        </div>

    </main>

</body>

</html>
