@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    <div class="flex flex-col items-center justify-center h-screen">
        <h1
            class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-teal-900 md:text-5xl lg:text-6xl dark:text-white">
            {{ __('succes.message_title') }}</h1>
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 text-center"
            role="alert">
            <span class="font-medium">{{ __('succes.subtitle') }} </span> {{ __('succes.message') }}
            <b>#{{ $viewData['order'] }}</b>
        </div>
        <a href={{ route('user.orders') }}
            class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            {{ __('succes.button') }}
        </a>
         <img class="h-auto max-w-full" src="{{ asset('img/purchase.svg') }}" alt="image description">
    </div>
@endsection
