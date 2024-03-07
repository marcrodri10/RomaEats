<x-guest-layout>
    <div class="flex justify-center">
        <a href="{{ route('index')}}">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('surname')" required autofocus autocomplete="surname" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- surname -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('Surame')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-center items-center mt-8">

            <x-primary-button value="" class="ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="flex justify-center items-center mt-7">
            @if (Route::has('login'))
                <p
                    class=" text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Already have an account?
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}">
                        {{ __('Sign in') }}
                </p>
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>

