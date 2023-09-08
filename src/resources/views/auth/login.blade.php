@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12">
            <div class="bg-white shadow-md rounded px-4 py-4">
                <div class="text-center text-2xl font-semibold mb-4">{{ __('Login') }}</div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-md font-medium text-gray-700">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="text-sm text-red-600" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-md font-medium text-gray-700">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="text-sm text-red-600" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="remember" class="inline-flex items-center">
                            <input class="form-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2 text-md text-gray-600">{{ __('Remember Me') }}</span>
                        </label>
                    </div>
                    <div class="mb-0 text-center">
                        <button type="submit" class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg">{{ __('Login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
