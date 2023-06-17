<x-guest-layout>
    <section class="min-h-screen flex items-stretch text-white ">
        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center bg-right" style="background-image: url(images/bg-friend.jpg);">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            <div class="w-full px-24 z-10">
                <h1 class="text-5xl font-bold text-left tracking-wide">Friendify</h1>
                <p class="text-3xl my-4">Connections is through world! We Find Happines!</p>
            </div>
        </div>
        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #FFFFFF;">
            <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center bg-right" style="background-image: url(images/bg-friend.jpg);">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>
            <div class="w-full py-6 z-20">

                <!-- Application Logo -->
                <h1 class="my-6">
                    <x-application-logo width="auto" height="100" color="red" />
                </h1>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                    @csrf
                    <!-- Email Address -->
                    <div class="pb-2 pt-4">
                        <!-- <x-input-label for="email" :value="__('Email')" /> -->
                        <x-text-input placeholder="Email" id="email" class="block w-full p-4 text-lg rounded-sm bg-white text-black" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="pb-2 pt-4">
                        <!-- <x-input-label for="password" :value="__('Password')" /> -->
                        <x-text-input id="password" class="block w-full p-4 text-lg rounded-sm bg-white text-black" placeholder="Password" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4 text-start">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm lg:text-gray-700 text-gray-200">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                    <a class="text-sm text-right lg:text-gray-500 text-gray-400 hover:underline hover:text-gray-100" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif


                    <x-primary-button class="mt-2 uppercase w-full block text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">
                        {{ __('Log in') }}
                    </x-primary-button>

                    <p class="mt-2 lg:text-gray-700 text-gray-200">Need an account?
                        <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                            Create an account
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>