@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex justify-center">
            <div class="w-full md:w-8/12 lg:w-6/12">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded px-4 py-4">
                    <div class="text-center text-2xl font-semibold mb-4 text-gray-800 dark:text-white">{{ __('Register') }}
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name"
                                class="block text-md font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                            <input id="name" type="text"
                                class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white @error('name') border-red-500 @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email"
                                class="block text-md font-medium text-gray-700 dark:text-gray-300">{{ __('Email Address') }}</label>
                            <input id="email" type="email"
                                class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="username"
                                class="block text-md font-medium text-gray-700 dark:text-gray-300">{{ __('Username') }}</label>
                            <input id="username" type="username"
                                class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror"
                                name="username" value="{{ old('username') }}" required autocomplete="username">

                            @error('username')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password"
                                class="block text-md font-medium text-gray-700 dark:text-gray-300">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror"
                                name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="password-confirm"
                                class="block text-md font-medium text-gray-700 dark:text-gray-300">{{ __('Confirm Password') }}
                            </label>
                            <input id="password-confirm" type="password"
                                class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="mb-0 text-center">
                            <button type="submit"
                                class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
