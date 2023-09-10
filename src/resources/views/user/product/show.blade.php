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

            <label class="text-gray-700 text-sm" for="count"> {{ $viewData['count_title'] }}</label>
            <div class="flex items-center mt-1">
                <button id="less" class="text-gray-500 focus:outline-none focus:text-gray-600" onclick="decrementCount()">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
                <span id="count" class="text-gray-700 text-lg mx-2">1</span>
                <button id="more" class="text-gray-500 focus:outline-none focus:text-gray-600" onclick="incrementCount()">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>

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
        <div class="flex items-center mt-6">
            <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Order Now</button>
            <form method="POST" action="{{ route('cart.add', ['id' => $viewData['product']->getId()]) }}">
                @csrf
                <input type="hidden" name="quantity" id="quantity" value="1">
                <button type="submit" class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none flex items-center">
                    <svg class="h-5 w-5 inline-block mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    
                </button>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('/js/count.js') }}"></script>
@endsection
