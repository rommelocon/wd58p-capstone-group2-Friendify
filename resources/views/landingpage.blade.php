<html> 
    <head>
    <link rel="stylesheet" href="landingp.css">
    </head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

<section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Sample image">
                </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="current-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Remember Me -->
                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif

                                        <x-primary-button class="ml-3">
                                            {{ __('Log in') }}
                                        </x-primary-button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                        <!-- Copyright -->
                            <div class="text-white mb-3 mb-md-0">
                            Copyright © 2020. All rights reserved.
                            </div>
                        <!-- Copyright -->

                        <!-- Right -->
                        <div>
                            <a href="#!" class="text-white me-4">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#!" class="text-white me-4">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#!" class="text-white me-4">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#!" class="text-white">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            </div>
                        <!-- Right -->
                    </div>
</section>


            


</x-app-layout>
</html>