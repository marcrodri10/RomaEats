<div class="full w-100 mt-32 flex justify-center">
    <div class="product w-90 flex items-center">
        <div
            class="w-100 flex flex-col lg:flex-row ml-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-5">
            @if ($img)
                @foreach ($array->toArray() as $key => $value)
                    @if (strpos($key, 'image') !== false)
                        <div class="lg:w-50 w-100 flex justify-center">

                            <img src="{{$src}}{{ $array->$key }}"
                                alt="shop-cart" class="h-100 w-auto">
                        </div>
                    @endif
                @endforeach

            @endif
            <div class="lg:w-50 w-100 flex flex-col justify-center p-2">
                <div class="flex flex-col gap-6 items-center">
                    @isset($order)
                        @foreach ($array->toArray() as $key => $value)
                            @isset($order[$loop->index])
                                <div class="product-data flex">
                                    <h2 class="text-xl font-bold">
                                        {{ ucfirst(explode('_', $order[$loop->index])[sizeof(explode('_', $order[$loop->index])) - 1]) }}</h2>
                                    <p class="text-xl">: {{ $array[$order[$loop->index]] }}</p>
                                </div>
                            @endisset
                        @endforeach
                    @else
                        @foreach ($array->toArray() as $key => $value)
                            @if (!in_array($key, $exceptions) && $value !== '')
                                <div class="product-data flex">
                                    <h2 class="text-xl font-bold">
                                        {{ ucfirst(explode('_', $key)[sizeof(explode('_', $key)) - 1]) }}</h2>
                                    <p class="text-xl">: {{ $value }}</p>
                                </div>
                            @endif
                        @endforeach
                    @endisset
                    <h2 class="mb-5 text-xl font-bold tracking-tight text-gray-900 dark:text-white"></h2>
                </div>
            </div>
        </div>
    </div>

</div>
