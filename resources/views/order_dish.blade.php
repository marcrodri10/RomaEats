<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/components/order-dish.css', 'resources/js/components/order-dish.js'])
</head>

<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main class="dishes mt-32 flex justify-center w-100">
        <div class="user-order w-90 flex justify-center">
            <form method="POST" action="{{ route('payment.pay') }}" class="w-2/5">
                <div class="user-payment">
                    <div class="sending p-4 flex flex-col justify-center">
                        <p class="text-xl">Entrega</p>

                        @csrf
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('País/Región')" />

                            <select id="countries"
                                class=" border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5">
                                <option selected value="es">España</option>

                            </select>
                        </div>
                        <div class="mt-4 flex gap-10">
                            <div class="name w-50">
                                <x-input-label for="name" :value="__('Nombre')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    value="{{auth()->user()->name}}" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="surname w-50">
                                <x-input-label for="surname" :value="__('Apellidos')" />
                                <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname"
                                    value="{{auth()->user()->surname}}" required autofocus />
                                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                            </div>

                        </div>
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                value="{{auth()->user()->address ? auth()->user()->address : ''}}" required autofocus />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                        <div class="mt-4 flex gap-10">
                            <div class="name w-50">
                                <x-input-label for="code" :value="__('Código Postal')" />
                                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code"
                                    :value="old('code')" required autofocus />
                                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            </div>
                            <div class="surname w-50">
                                <x-input-label for="city" :value="__('Ciudad')" />
                                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                    :value="old('city')" required autofocus />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                            <div class="surname w-50">
                                <x-input-label for="surname" :value="__('Provincia')" />
                                <select id="countries"
                                    class=" border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5">
                                    <option selected value="Barcelona">Barcelona</option>

                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="payment bg-gray-200 p-4 flex flex-col justify-center">
                        <p class="text-xl">Pago</p>
                        @if(sizeof($userCards) > 0)
                            <div class="cards mt-6">
                                @foreach ($userCards as $card)
                                    <x-input-radio class="card-radio" name="{{$card->card_id}}" id="{{$card->card_id}}"
                                        value="{{$card->card_id}}">Tarjeta {{$card->card_number}}</x-input-radio>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-4">
                            <x-input-label for="card" :value="__('Número de tarjeta')" />
                            <x-text-input id="card" class="block mt-1 w-full" type="text" name="card"
                                value="" required />
                            <x-input-error :messages="$errors->get('card')" class="mt-2" />
                        </div>
                        <div class="mt-4 flex gap-10">
                            <div class=" w-50">
                                <x-input-label for="validation_date" :value="__('Fecha de vencimiento')" />
                                <x-text-input id="validation_date" class="block mt-1 w-full" type="text" name="validation_date"
                                value="" required autofocus maxlength="0"/>
                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>
                            <div class=" w-50">
                                <x-input-label for="cvv" :value="__('CVV')" />
                                <x-text-input id="surname" class="block mt-1 w-full" type="text" name="cvv"
                                value="" required autofocus />
                                <x-input-error :messages="$errors->get('cvv')" class="mt-2" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Nombre del titular')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <!-- Email Address -->
                        <x-input-checkbox name="save_card" class="mt-6">Guardar método de pago para futuros pagos.</x-input-checkbox>
                    </div>

                    <div class="flex justify-center mt-6 ">

                        <x-primary-button type="submit" value="pay"
                            class="w-50 ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center"
                            name="payment" value="pay">Pagar</x-primary-button>
                        <x-primary-anchor href="{{route('dishes')}}" value="cancel"
                            class="w-50 ms-3 bg-red-800 pt-4 pb-4 pl-10 pr-10 flex justify-center"
                            name="payment" value="cancel">Cancelar</x-primary-anchor>
                    </div>
            </form>

        </div>
        <div class="order-summary w-2/5 p-6">



            @foreach ($userOrder as $order)
                <div class="dish-info flex justify-between items-center mb-4">
                    <img src="../img/{{ $order->dish_image }}" alt="" class="h-14 w-20">
                    <h1 class="text-center">{{ $order->dish_name }} (x{{ $order->user_quantity }})</h1>
                    <p>{{ $order->dish_price }}€</p>
                </div>
            @endforeach
            <div class="summary-orde flex mt-10 justify-between">
                <p>Total</p>
                <p>{{ session('order_dish_amount') }}€</p>
            </div>

        </div>

        </div>

    </main>
</body>
