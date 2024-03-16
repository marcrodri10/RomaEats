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

    @vite(['resources/css/app.css', 'resources/css/components/products.css', 'resources/js/components/products.js'])
</head>

<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main class="products-div mt-32 flex justify-center flex-col items-center">
        <div class="user-products-container w-90 flex justify-center flex-col items-center" id="products-div">
            <h1 class="title">Mis productos</h1>

            @if (session('product_add') === 'added')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
            @if (session('error'))
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="error text-sm text-gray-600 dark:text-gray-400">{{ session('error') }}</p>
            @endif
            @if (sizeof($products) == 0)
                <div class="empty flex flex-col justify-center items-center mt-40 h-80">
                    <p>Todavía no has añadido ningún producto</p>
                    <x-button-with-icon id="add-btn" value="add" type="button"
                        class="ms-3 bg-green-700 pt-3 pb-3 pl-7 pr-7 flex justify-center mt-8 modal relative"
                        href="dishes">
                        {{ __('AÑADIR') }}
                    </x-button-with-icon>
                </div>
            @else
                <div class="card-group w-90" id="products">

                    @foreach ($products as $product)

                        <x-add-cart-card href="{{ route('product.show', ['id' => $product->user_product_id]) }}"
                            id="product{{ $product->user_product_id }}">

                                <div class="w-100 h-50 flex justify-center">
                                    <img src="https://images.openfoodfacts.org/images/products/{{ $product->user_product_image }}"
                                        alt="dish" class="w-auto h-100 dish-image">
                                </div>
                                <div class="product-info w-100 h-25 flex flex-col justify-center items-center">

                                    <div class="h-1/4">
                                        <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $product->user_product_name }} </h2>
                                    </div>
                                    <div class="h-1/4 flex items-center ">
                                        <p class=" font-normal text-gray-700 dark:text-gray-400">{{ $product->user_product_price }}€</p>
                                    </div>
                                </div>


                        </x-add-cart-card>
                    @endforeach

                </div>
                <div class="add-btn">
                    <x-button-with-icon id="add-btn" value="add" type="submit"
                        class="ms-3 bg-green-700 pt-3 pb-3 pl-7 pr-7 flex justify-center mt-8 modal" href="dishes">
                        {{ __('') }}
                    </x-button-with-icon>
                </div>
            @endif
        </div>
        @csrf
        @method('post')
        <div class="product-form w-100 flex justify-center">
            <form action="{{ route('save.product') }}" method="post"
                class="width-80 absolute top-0 mt-32 hidden p-16 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                id="product-form">
                @csrf
                <div class="flex justify-between items-center">
                    <x-button type="button" value="scan" id="scan-btn" type="button"
                        class="bg-green-700 pt-3 pb-3 pl-7 pr-7 flex justify-center" href="dishes">
                        {{ __('ESCANEAR') }}
                    </x-button>
                    <div id="close-modal">
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white modal"
                            data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>
                <div class="content-form mt-10">
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="search-product"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  focus:border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Código de barras" value="" name="search" autocomplete="off">

                    </div>
                    <div id="product" class="flex flex-col justify-center items-center mt-10">

                    </div>
                    <div id="scan"></div>
                    <div class="reader-div flex justify-center mt-10">
                        <div id="reader" class=""></div>
                    </div>

                    <div id="product">
                    </div>
                </div>
            </form>
        </div>
    </main>

</body>
