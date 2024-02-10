<div class=" bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 food-dish">
    <div class="w-50">
        <img src="{{URL::to('img/landing1.jpeg')}}" alt="shop-cart" class="">
    </div>
    <div class="dish-info p-5 flex flex-col justify-center">

        <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {{ $slot }}</h2>

        <p class="mb-10 font-normal text-gray-700 dark:text-gray-400">{{ $price }}€</p>
        <x-primary-button class="ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8 flex justify-center">
            {{ __('Añadir') }}
        </x-primary-button>
    </div>
</div>
