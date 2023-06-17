<x-guest-layout>
    <!-- url('/img/hero-pattern.svg') -->
    <div class="flex min-h-screen bg-white">

        <div class="w-1/2 bg-cover md:block hidden bg-center" style="background-image:  url(images/bg-friend2.jpg)"></div>
        <!-- <div class="bg-no-repeat bg-right bg-cover max-w-max max-h-8 h-12 overflow-hidden">
            <img src="log_in.webp" alt="hey">
        </div> -->


        <div class="md:w-1/2 max-w-lg mx-auto my-auto px-4 py-5 shadow-none">

            <div class="w-full z-10">
                <h1 class="text-5xl font-bold text-left tracking-wide">Create an account for free</h1>
                <p class="text-lg my-4">Free forever. No payment needed.</p>
            </div>
            <form method="POST" action="{{ route('register') }}" class="p-0">
                @csrf

                <!-- Email Address -->
                <div class="mt-4">
                    <x-text-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Name -->
                <div class="mt-4">
                    <x-text-input placeholder="Name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-text-input placeholder="Password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-text-input placeholder="Confirm Password" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-primary-button class="mt-2 uppercase w-full block text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">
                        {{ __('Register') }}
                    </x-primary-button>


                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>