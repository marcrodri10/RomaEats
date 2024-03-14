
<div class="bg-white flex-grow-1 border flex-grow-1 border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 food-dish mt-5" id="product{{$id}}">
    <a href="{{$href}}">
    <div class="w-100 h-50">
        <img src="{{URL::to('img/'.$img)}}" alt="dish" class="w-100 h-100 dish-image">
    </div>
    <div class="dish-info p-3 flex flex-col h-25 justify-between">
        <div class="h-1/4">
            <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {{ $slot }}</h2>
        </div>

        <div class="h-1/4 flex items-center ">
            <p class=" font-normal text-gray-700 dark:text-gray-400">{{ $price }}€</p>
        </div>


    </div>
</a >
    <div class="flex justify-evenly items-center h-25 buttons">
        <x-primary-button type="submit" id="add" value="add" class="ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8 flex justify-center">
            {{ __('Añadir') }}
        </x-primary-button>
        <x-input-number></x-input-number>
    </div>
</div>
