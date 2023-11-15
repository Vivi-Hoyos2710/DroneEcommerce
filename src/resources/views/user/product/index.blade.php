@extends('layouts.app')
@section('title', __('product.title'))
@section('subtitle',__('products_list') )

@section('content')


    {{ Breadcrumbs::render('products') }}

    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">{{ __('product.title') }}</h3>
        <h3 class="text-gray-600 text-2xl font-medium">{{ $viewData["subtitle"] }}</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
            @forelse($viewData["products"] as $product)
                <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                    <div class="flex items-end justify-end h-56 w-full bg-cover"
                        style="background-image: url('{{ url( $product->getImage()) }}');">
                        <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
                            class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500 flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 20">
                                <circle cx="7" cy="7" r="7" fill="currentColor" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 13A6 6 0 1 0 7 1a6 6 0 0 0 0 12Zm0 0v6M4.5 7A2.5 2.5 0 0 1 7 4.5" />
                            </svg>
                        </a>
                    </div>
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{ $product['name'] }}</h3>
                        <span class="text-gray-500 mt-2">{{ __('product.price') }}: {{ $product->getPrice() }}</span>
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
