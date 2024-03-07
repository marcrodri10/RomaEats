<div id="shopping-cart-modal" class="h-100 overflow-y-scroll p-4 w-3/12 z-50 bg-white shadow-2xl fixed top-0 right-0 hidden">
    <div class="close flex justify-end" id="close-cart">
        <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="static-modal" id="close-shopping-cart">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>

    <div class="cart-message w-100 flex flex-col justify-start items-center gap-5 ">
        <h2>Todavía no hay rutas</h2>
        <x-primary-button value="see-more" class="ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8">
            {{ __('Añadir rutas') }}
        </x-primary-button>
    </div>
</div>
