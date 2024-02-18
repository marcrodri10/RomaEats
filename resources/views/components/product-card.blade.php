<div class="ml-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 food-product mt-5">
    <div class="w-100 h-50 flex justify-center">
        <img src="https://images.openfoodfacts.org/images/products/{{$img}}" alt="shop-cart" class="h-100 w-auto">
    </div>
    <div class="w-100 flex flex-col h-50 justify-center p-2">
        <div class="flex h-50">
            <h2 class="mb-5 text-xl font-bold tracking-tight text-gray-900 dark:text-white"> {{ $slot }}</h2>
        </div>

        <div class="flex justify-center h-50 items-center">
            <x-primary-anchor href="{{ route('show.product', ['id' => $id]) }}" class=" bg-green-700 pt-5 pb-5 pl-8 pr-8 flex justify-center h-50">
                {{ __('Ver') }}
            </x-primary-anchor>
        </div>

    </div>
</div>
