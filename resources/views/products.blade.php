<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/components/products.js'])
</head>
<body>
    <x-navbar><x</x-navbar>
    <div class="products mt-32 flex justify-center flex-col items-center">
        <h1 class="underline">My products</h1>
        @if (sizeof($products) == 0)
            <div class="empty-products flex flex-col justify-center items-center mt-40 h-80">
                <p>Todavía no has añadido ningún producto</p>
                <x-primary-button class="ms-3 bg-green-700 pt-3 pb-3 pl-7 pr-7 flex justify-center mt-8" href="dishes">
                    {{ __('AÑADIR') }}
                </x-primary-button>
            </div>
        @else
        @endif
        <form class="add-product w-2/6" id="form">
            <x-search-input placeholder="Código de barras del producto"></x-search-input>
            <x-primary-button id="scan-btn" class="ms-3 bg-green-700 pt-3 pb-3 pl-7 pr-7 flex justify-center mt-8" href="dishes">
                {{ __('ESCANEAR') }}
            </x-primary-button>
            <div id="scan"></div>
            <div id="reader" width="600px" height="600px"></div>
            <div id="producto"></div>
        </form>
    </div>
</body>
