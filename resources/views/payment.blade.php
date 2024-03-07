<x-guest-layout>
    <div class="flex justify-center">
        <a href="{{ route('index')}}">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </div>
    <form method="POST" action="{{ route('payment.pay') }}">
        @csrf
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('cvv')" required autofocus />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="card" :value="__('Card number')" />
            <x-text-input id="card" class="block mt-1 w-full" type="text" name="card" :value="old('email')" required />
            <x-input-error :messages="$errors->get('card')" class="mt-2" />
        </div>
        <!-- surname -->
        <div class="mt-4">
            <x-input-label for="cvv" :value="__('Cvv')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="cvv" :value="old('cvv')" required autofocus />
            <x-input-error :messages="$errors->get('cvv')" class="mt-2" />
        </div>


        <div class="flex justify-center items-center mt-8">

            <x-primary-button value="pay" name="payment" class="ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8">
                {{ __('Pay') }}
            </x-primary-button>

            <x-primary-anchor href="{{route('dishes')}}" class="ms-3 bg-red-700 pt-3 pb-3 pl-8 pr-8">
                {{ __('Cancel') }}
            </x-primary-anchor>
        </div>

    </form>

</x-guest-layout>

