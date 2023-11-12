@extends('layouts.app')
@section('title', __('product.title'))
@section('subtitle',__('products_list') )
@section('content')
    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">{{ __('product.title') }}</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
            @forelse($viewData["products"] as $productName => $productQuantity)
                <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden dark:bg-black"   
                >
                    <div class="px-5 py-3 bg-white dark:bg-black">
                        <h3 class="text-gray-700 uppercase">{{ $productName }}</h3>
                        <h3 class="text-gray-700 uppercase">{{ $productQuantity }}</h3>
                    </div>
                </div>
            @empty
                <div class="flex justify-center items-center">
                    <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                        role="alert">
                        <span class="font-medium">{{ __('product.empty_message') }}</span>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
