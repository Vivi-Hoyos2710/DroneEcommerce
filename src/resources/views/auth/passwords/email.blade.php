@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex justify-center">
            <div class="w-full md:w-8/12 lg:w-6/12">
                <div class="bg-white shadow-md rounded px-4 py-4">
                    <div class="text-center text-2xl font-semibold mb-4">{{ __('Reset Password') }}</div>

                    @if (session('status'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4"
                            role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email"
                                class="block text-md font-medium text-gray-700">{{ __('Email Address') }}</label>
                            <input id="email" type="email"
                                class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-0 text-center">
                            <button type="submit"
                                class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg">{{ __('Send Password Reset Link') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
