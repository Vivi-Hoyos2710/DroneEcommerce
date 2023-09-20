@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex justify-center">
            <div class="w-full md:w-8/12 lg:w-6/12">
                <div class="bg-white shadow-md rounded px-4 py-4">
                    <div class="text-center text-2xl font-semibold mb-4">{{ __('Confirm Password') }}</div>
                    <p class="mb-4">{{ __('Please confirm your password before continuing.') }}</p>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="password"
                                class="block text-md font-medium text-gray-700">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 @error('password') border-red-500 @enderror"
                                name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-0 text-center">
                            <button type="submit"
                                class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg">{{ __('Confirm Password') }}</button>

                            @if (Route::has('password.request'))
                                <a class="text-blue-500 hover:underline text-sm mt-2"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
