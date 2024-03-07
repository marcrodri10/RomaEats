<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app-employee.js', 'resources/css/components/orders.css', 'resources/js/components/delivery-route.js'])
</head>

<body>
    <x-navbar-employee></x-navbar-employee>
    <main class="container-div mt-32 flex justify-center flex-col items-center" id="products-div">


        <div id="map" class="mt-6"></div>

        <div id="map-info"></div>
    </main>

</body>
