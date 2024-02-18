<!DOCTYPE html>
<html lang="800px !important;
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/components/product-full.css'])
</head>
<body>
    <x-navbar><x</x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <div class="product-full w-100 mt-32 flex justify-center">
        <div class="product width-80 flex items-center">
            <div class="w-100 flex ml-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 food-product mt-5">
                <div class="w-50 flex justify-center">
                    <img src="https://images.openfoodfacts.org/images/products/{{$product->user_product_image}}" alt="shop-cart" class="h-100 w-auto">
                </div>
                <div class="w-50 flex flex-col justify-center p-2">
                    <div class="flex flex-col gap-6">
                        @foreach ($product->toArray() as $key => $value)
                            @if($key !== 'created_at' && $key !== 'updated_at' && $key !== 'user_id' && $key !== 'user_product_id' && $key !== 'user_product_image')
                                <div class="product-data flex">
                                    <h2 class="text-xl font-bold">{{ucfirst(str_replace('_', ' ', substr($key, 13, strlen($key))))}}</h2>
                                    <p class="text-xl">: {{$value}}</p>
                                </div>

                            @endif
                        @endforeach
                        <h2 class="mb-5 text-xl font-bold tracking-tight text-gray-900 dark:text-white"></h2>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
