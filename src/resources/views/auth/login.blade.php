@extends('layouts.app',['body_class' => 'bg-custom-background'])

@section('content')

  <div class="container">
    <div class="flex justify-center">
      <div class="w-full md:w-8/12 lg:w-6/12">
        <div class="bg-white rounded-lg shadow-md px-6 py-8 dark:border dark:bg-gray-800 dark:border-gray-700">
          <h1 class="text-2xl font-semibold text-center text-gray-800 dark:text-white mb-4">{{ __('Login') }}</h1>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
              <input id="email" type="email" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="text-sm text-red-600" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="mb-4">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
              <input id="password" type="password" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
              @error('password')
              <span class="text-sm text-red-600" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
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