<div class="full w-100 mt-32 flex justify-center">
    <div class="product w-90 flex items-center">
        <div class="w-100 flex flex-col lg:flex-row ml-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-5">
            @if ($img)
                @foreach ($array->toArray() as $key => $value)
                    @if (strpos($key, 'image') !== false)
                    <div class="lg:w-50 w-100 flex justify-center">

                        <img src="https://images.openfoodfacts.org/images/products/{{ $array->$key }}"
                            alt="shop-cart" class="h-100 w-auto">
                    </div>
                    @endif
                @endforeach

            @endif
            <div class="lg:w-50 w-100 flex flex-col justify-center p-2">
                <div class="flex flex-col gap-6 items-center">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($array->toArray() as $key => $value)
                        @if($i < sizeof($order))
                            <div class="product-data flex">
                                <h2 class="text-xl font-bold">
                                    {{ ucfirst(explode('_', $order[$i])[sizeof(explode('_', $order[$i])) - 1]) }}</h2>
                                <p class="text-xl">: {{ $array[$order[$i]] }}</p>
                            </div>
                            @php
                            $i++;
                            @endphp
                        @endif

                    @endforeach
                    <h2 class="mb-5 text-xl font-bold tracking-tight text-gray-900 dark:text-white"></h2>
                </div>
            </div>
        </div>
    </div>

</div>


