@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')

    <div class="relative overflow-x-auto">
        <h1 class="text-3xl font-extrabold dark:text-white">{{ __('review.reviewTitle') }}</h1>

        <div class="container mx-auto p-4 flex flex justify-evenly items-center">
            <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ __('adminpanel.rejected') }}</h5>

                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{ __('adminpanel.total') }}:{{$viewData['totalRejected']}}
                </p>
                <a href="{{ route('admin.reviews.rejected') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    +
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
            <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ __('adminpanel.accepted') }}</h5>

                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{ __('adminpanel.total') }}:{{$viewData['totalAccepted']}}

                </p>
                <a href="{{ route('admin.reviews.accepted') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    +
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>



        </div>

    </div>
@endsection
