@extends('layouts.app')


@section('title', $viewData["title"])

@section('subtitle', $viewData["subtitle"])

@section('content')

<div class="md:flex md:items-center">
    <div class="w-full h-64 md:w-1/2 lg:h-96">
        <!-- This is the product image -->
        <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{ asset('storage/' . $viewData['product']->getImage()) }}" alt="{{ $viewData['product']->getName() }}">   
    </div>
    <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
        <h3 class="text-gray-700 uppercase text-lg"> {{ $viewData['product'] -> getName()}} </h3>
        <span class="text-gray-500 mt-3"> {{ $viewData['product'] -> getPrice()}} </span>
        <hr class="my-3">
        <div class="mt-2">
            <!-- Here we write the product data -->

            <div class="grid grid-cols-2 gap-4">
                <!-- Description -->
                <div>
                    <label class="text-gray-700 text-sm" for="count">{{ $viewData['description_title'] }}</label>
                    <p class="mt-1 text-gray-600 text-sm">{{ $viewData['product']->getDescription() }}</p>
                </div>

                <!-- Size -->
                <div>
                    <label class="text-gray-700 text-sm" for="count">{{ $viewData['size_title'] }}</label>
                    <p class="mt-1 text-gray-600 text-sm">{{ $viewData['product']->getSize() }}</p>
                </div>

                <!-- Brand -->
                <div>
                    <label class="text-gray-700 text-sm" for="count">{{ $viewData['brand_title'] }}</label>
                    <p class="mt-1 text-gray-600 text-sm">{{ $viewData['product']->getBrand() }}</p>
                </div>

                <!-- Category -->
                <div>
                    <label class="text-gray-700 text-sm" for="count">{{ $viewData['category_title'] }}</label>
                    <p class="mt-1 text-gray-600 text-sm">{{ $viewData['product']->getCategory() }}</p>
                </div>
            </div>


            <!-- This is the add to cart button -->
            <div class="flex items-center mt-1">
                <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500"> {{ $viewData['cart_title'] }} </button>
            </div>
        </div>
    </div>
</div>
@endsection
