<div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 food-dish mt-5" id="product{{$id}}">
    <div class="w-100 h-50">
        <img src="{{URL::to('img/landing1.jpeg')}}" alt="shop-cart" class="w-100 h-100">
    </div>
    <div class="dish-info p-3 flex flex-col justify-between h-50">
        <div class="h-1/3">
            <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {{ $slot }}</h2>
        </div>

        <div class="h-1/3 flex items-center ">
            <p class=" font-normal text-gray-700 dark:text-gray-400">{{ $price }}€</p>
        </div>

        <div class="flex justify-evenly h-50 items-center h-1/3">
            <x-primary-button id="add" value="add" class="ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8 flex justify-center">
                {{ __('Añadir') }}
            </x-primary-button>
            <x-input-number></x-input-number>
        </div>
    </div>
</div>
