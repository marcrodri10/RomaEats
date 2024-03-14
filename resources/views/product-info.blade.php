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
    <main>
        <x-full-card>
            <div class="p-6 w-100 flex flex-col lg:flex-row ml-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="lg:w-50 w-100 flex justify-center">
                    <img src="https://images.openfoodfacts.org/images/products/{{ $product->user_product_image }}" alt="dish" class="h-auto w-auto dish-image">
                </div>
                <div class="product-info lg:w-50 w-100 flex flex-col gap-10">
                    <div class="flex flex-col justify-center">
                        <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                            Nombre</h2>
                            <p class="text-center">{{ $product->user_product_name }}</p>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                            Precio</h2>
                            <p class="text-center">{{ $product->user_product_price }}€</p>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                            Código de barras</h2>
                            <p class="text-center">{{ $product->user_product_code }}</p>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                            Marca</h2>
                            <p class="text-center">{{ $product->user_product_brand }}</p>
                    </div>
                    @if($product->user_product_category != '')
                    <div class="flex flex-col justify-center">
                        <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                            Categoría</h2>
                            <p class="text-center">{{ $product->user_product_category }}</p>
                    </div>
                    @endif

                    @if($product->user_product_store_location != '')
                    <div class="flex flex-col justify-center">
                        <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                            Localización</h2>
                            <p class="text-center">{{ $product->user_product_store_location }}</p>
                    </div>
                    @endif

                    @if($product->user_product_nutri_score != '')
                    <div class="flex flex-col justify-center">
                        <h2 class="text-center mb-5 text-lg font-bold text-gray-900 dark:text-white">
                            Nutri Score</h2>
                            <p class="text-center">{{ $product->user_product_nutri_score }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </x-full-card>
    </main>


</body>
</html>
