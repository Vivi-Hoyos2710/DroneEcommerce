@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')


    <div class="flex flex-col items-center justify-center h-screen">
        <h1 class="text-5xl font-extrabold dark:text-white">
            {{ $viewData['message'] }}
            <small class="ml-2 font-semibold text-gray-500 dark:text-gray-400">
                {{ __('adminpanel.admin_panel') }}
            </small>
        </h1>
        <img class="h-auto max-w-md my-6" src="{{ asset('img/adminPanel.svg') }}" alt="image description">
    </div>

@endsection
