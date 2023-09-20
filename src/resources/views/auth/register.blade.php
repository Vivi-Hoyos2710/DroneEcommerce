@extends('layouts.app',['body_class' => 'bg-custom-background'])

@section('content')
        <div class="container">
            <div class="flex justify-center">
                <div class="w-full md:w-8/12 lg:w-6/12">
                    <div class="bg-white rounded-lg shadow-md px-6 py-8 dark:border dark:bg-gray-800 dark:border-gray-700">
                        <h1 class="text-2xl font-semibold text-center text-gray-800 dark:text-white mb-4">
                            {{ __('Register') }}</h1>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white @error('name') border-red-500 @enderror"
                                    value="{{ old('name') }}" placeholder="{{ __('Name') }}" required>
                                @error('name')
                                    <span class="text-sm text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                <input type="email" name="email" id="email"
                                    class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror"
                                    value="{{ old('email') }}" placeholder="name@company.com" required>
                                @error('email')
                                    <span class="text-sm text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="username"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                <input type="text" name="username" id="username"
                                    class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white @error('username') border-red-500 @enderror"
                                    value="{{ old('username') }}" placeholder="{{ __('Username') }}" required>
                                @error('username')
                                    <span class="text-sm text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror"
                                    placeholder="••••••••" required>
                                @error('password')
                                    <span class="text-sm text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password-confirm"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                    Password</label>
                                <input id="password-confirm" type="password"
                                    class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white"
                                    name="password_confirmation" required placeholder="••••••••">
                            </div>

                            <div class="mb-0 text-center">
                                <button type="submit"
                                    class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg">{{ __('Register') }}
                                </button>
                                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                    Already have an account? <a href={{ route('login') }} class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
