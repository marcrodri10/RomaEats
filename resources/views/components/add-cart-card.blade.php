
<div class="bg-white flex-grow-1 border flex-grow-1 border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 food-dish mt-5" id="{{$id}}">
    <a href="{{$href}}">

        {{$slot}}
    </a >
    <div class="flex justify-evenly items-center h-25 buttons">
        <x-primary-button type="submit" id="add" value="add" class="ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8 flex justify-center">
            {{ __('Añadir') }}
        </x-primary-button>
        <x-input-number></x-input-number>
    </div>
</div>
