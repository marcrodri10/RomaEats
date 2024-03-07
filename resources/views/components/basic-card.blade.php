<div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 order mt-5" id="product{{$id}}">
    <div class="order-info p-3 flex flex-col justify-between">
        <div class="">
            <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {{ $slot }}</h2>
        </div>

        <div class="flex-col items-center">
            @isset($price)<p class=" font-normal text-gray-700 dark:text-gray-400">{{$price}}</p>@endisset
            @isset($status)<p class=" font-normal text-gray-700 dark:text-gray-400">{{$status}}</p>@endisset

            @isset($name, $surname)<p class=" font-normal text-gray-700 dark:text-gray-400">{{$name}} {{$surname}}</p>@endisset
            @isset($address)<p class=" font-normal text-gray-700 dark:text-gray-400">{{$address}}</p>@endisset
            @isset($phone)<p class=" font-normal text-gray-700 dark:text-gray-400">{{$phone}}</p>@endisset
        </div>

    </div>
</div>
