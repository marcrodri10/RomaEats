<main>
    <div class="w-100 product p flex justify-center">
        <div class="w-90 flex items-center">
            <div
                class="w-100 flex flex-col lg:flex-row ml-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="lg:w-50 w-100 flex justify-center">

                    <img src="@yield('img')" alt="dish" class="h-100 w-100 dish-image">
                </div>

                <div class="lg:w-50 w-100 flex flex-col p-6">
                    <div class="flex flex-col gap-6">
                        @yield('content')
                        <h2 class="mb-5 text-xl font-bold tracking-tight text-gray-900 dark:text-white"></h2>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

