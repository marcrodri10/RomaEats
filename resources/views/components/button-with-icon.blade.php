<div id="{{$id}}" class="button-icon flex justify-around">
    <button {{ $attributes->merge(['type' => 'submit', 'value' => $value,  'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
        {{ $slot }}
        <img src="img/add.svg" alt="add-icon" class="w-6">
    </button>

</div>

